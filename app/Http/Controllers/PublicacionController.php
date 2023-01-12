<?php

namespace App\Http\Controllers;

use App\Models\CaracteristicaComodidad;
use App\Models\Ciudad;
use App\Models\Comodidad;
use App\Models\DatosExtraUsuarios;
use App\Models\Imagen;
use App\Models\MercadoPagoTransaccion;
use App\Models\Provincia;
use App\Models\Publicacion;
use App\Models\PublicacionTipoInquilino;
use App\Models\Rating;
use App\Models\Solicitud;
use App\Models\TipoInquilino;
use App\Models\TipoPropiedad;
use App\Models\User;
use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PublicacionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //si el usuario tiene el rol de inquilino mostrar solo las publicaciones que esten alquiladas para ese usuario
        if(Auth::user()->hasRole('inquilino')){
            $publicaciones = Publicacion::get()->where('estado_publicacion','==', 'Alquilado')->where('id_inquilino', Auth::user()->id);
            $contrato = Contrato::get()->where('id_inquilino', Auth::user()->id);
        }elseif(Auth::user()->hasRole('propietario')){
            $publicaciones = Publicacion::where('id_usuario', Auth::user()->id)->get();
            $contrato = Contrato::get()->where('id_usuario', Auth::user()->id);
        }elseif(Auth::user()->hasRole('admin')){
            $publicaciones = Publicacion::all();
        }
        //mostrar las publicaciones que tengan el estado en 'Activo' y que pertenezcan al usuario autenticado
//        $publicaciones = Publicacion::where('estado_publicacion', 'Activo')->where('id_usuario', Auth::user()->id)->get();
        $solicitud_prop = Solicitud::get()->where('id_propietario',Auth::user()->id);

//        $publicaciones = Publicacion::get()->where('id_usuario',Auth::user()->id);
        $tiposPropiedades = TipoPropiedad::get();
        $imagenes = Imagen::get();

        $datosExtraUsuarios = DatosExtraUsuarios::get()->where('id_usuario',Auth::user()->id)->first();
        if ($datosExtraUsuarios == null){
            return redirect()->route('datosExtraUsuarios.create')->with('registro','no');
        }else{
            return view('publicaciones.index', compact('publicaciones', 'tiposPropiedades', 'imagenes', 'solicitud_prop', 'contrato'));
        }
//        dd($datosExtraUsuarios);

//        return view('publicaciones.index',compact('publicaciones','tiposPropiedades', 'imagenes'));
    }

    public function publicacionesAdmin()
    {
        $publicaciones = Publicacion::all();
        $tiposPropiedades = TipoPropiedad::get();
        $usuarios = User::get();

        return view('admin.publicaciones.activas',compact('publicaciones','tiposPropiedades', 'usuarios'));
    }

    public function pagar(Publicacion $publicacion, Request $request){

        $contrato = Contrato::where('id_publicacion', $publicacion->id)->where('id_inquilino', Auth::user()->id)->first();

        $payment_id = $request->get('payment_id');

        $respuesta = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-141489167613208-102209-72a86348e61a8e789f1e8739cf212924-1222873954");
        $respuesta = json_decode($respuesta);//se pueden sacar varios datos de la respuesta

        $id_transaccion = $respuesta->id;
        $status = $respuesta->status;//Aprobado o Rechazado o Pendiente
//        dd($status);
        $transaction_amount = $respuesta->transaction_amount;//obtener el monto de transaccion
        $payment_method_id = $respuesta->payment_method_id;//Obtener el metodo de pago(visa, mastercard, etc)
        $payment_type_id = $respuesta->payment_type_id;//Obtener el tipo de pago(credit_card, ticket, etc)

        if($status == 'approved'){
            $publicacion->estado_publicacion = 'Alquilado';
            $publicacion->id_inquilino = Auth::user()->id;
            $publicacion->save();

            //guardar datos en la tabla de mercado-pago-transacciones
            $mercadoPagoTransaccion = new MercadoPagoTransaccion();
            $mercadoPagoTransaccion->numero_transaccion = $id_transaccion;
            $mercadoPagoTransaccion->estado_transaccion = $status;
            $mercadoPagoTransaccion->monto_transaccion = $transaction_amount;
            $mercadoPagoTransaccion->metodo_pago = $payment_method_id;
            $mercadoPagoTransaccion->tipo_pago = $payment_type_id;
            $mercadoPagoTransaccion->id_usuario = Auth::user()->id;
            $mercadoPagoTransaccion->nombre_usuario = Auth::user()->name;
            $mercadoPagoTransaccion->id_contrato = $contrato->id;
//            $mercadoPagoTransaccion->id_contrato = 100;
            $mercadoPagoTransaccion->save();

//            //enviar correo al propietario de la publicacion (ver que onda con el envio de correos)
//            //obtener el correo del propietario de la publicacion
//            $propietario = User::find($publicacion->id_usuario);
//            $correoPropietario = $propietario->email;
//            //funcion para enviar correo al propietario de la publicacion
//            $this->enviarCorreo($correoPropietario, $publicacion);
//            $propietario = User::find($publicacion->id_usuario);
//            $propietario->notify(new \App\Notifications\PublicacionAlquilada($publicacion));

            return redirect()->route('publicaciones.index')->with('alquilado','ok');
        }elseif ($status == 'pending'){
            return redirect()->route('publicaciones.index')->with('pendiente','pend');
        }elseif ($status == 'in_process'){
            return redirect()->route('publicaciones.index')->with('pendiente','pend');
        }elseif ($status == 'rejected'){

            $mercadoPagoTransaccion = new MercadoPagoTransaccion();
            $mercadoPagoTransaccion->numero_transaccion = $id_transaccion;
            $mercadoPagoTransaccion->estado_transaccion = $status;
            $mercadoPagoTransaccion->monto_transaccion = $transaction_amount;
            $mercadoPagoTransaccion->metodo_pago = $payment_method_id;
            $mercadoPagoTransaccion->tipo_pago = $payment_type_id;
            $mercadoPagoTransaccion->id_usuario = Auth::user()->id;
            $mercadoPagoTransaccion->nombre_usuario = Auth::user()->name;
            $mercadoPagoTransaccion->id_contrato = $contrato->id;
//            $mercadoPagoTransaccion->id_contrato = 100;
            $mercadoPagoTransaccion->save();

            return redirect()->route('publicaciones.index')->with('rechazado', 'rej');
        }
    }

    public function show(Publicacion $publicacion, CaracteristicaComodidad $caracteristicaComodidad)
    {
        $imagenes = Imagen::get();
//        $comentarios = Comentario::get()->where('id_publicacion',$publicacion->id);
        $ratings = Rating::get()->where('id_publicacion',$publicacion->id);
//        $solicitud = Solicitud::get()->where('id_publicacion',$publicacion->id)->where('id_usuario',Auth::user()->id)->first();
        $solicitud = Solicitud::get()->where('id_publicacion',$publicacion->id)->where('id_usuario',Auth::user()->id)->where('estado_solicitud','!=','Nulo')->sortBy('created_at', SORT_REGULAR, true)->first();
//        $solicitud_prop = Solicitud::get()->where('id_publicacion',$publicacion->id)->where('id_propietario',$publicacion->id_usuario)->where('estado_solicitud','=','Aceptado')->where('id_usuario',$solicitud->id_usuario)->first();
//        dd($solicitud_prop);
        if ($solicitud == null){
            $solicitud = new Solicitud();
            $solicitud->estado_solicitud = 'Nulo';
        }elseif ($solicitud->estado_solicitud == 'Rechazado'){
            //establecer mensaje de sesion
            session()->flash('rechazado','ok');
        }elseif ($solicitud->estado_solicitud == 'Aceptado'){
            //establecer mensaje de sesion
            session()->flash('aceptado','ok');
//            session()->forget('aceptado');
        }
        $contratos = Contrato::get()->where('id_publicacion',$publicacion->id)->where('baja_contrato',null);//Ver si esta condicion nunca falla
//        dd($contratos->first()->id);
        if (isset($contratos->first()->id)){
            $contrato_id = $contratos->first()->id;
        }else{
            $contrato_id = null;
        }
//        dd($contrato_id);
//        ->sortBy('created_at', SORT_REGULAR, true)->first()
//        dd($contratos);
//        if ($contratos == null) {
//            $contratos = new Contrato();
//            $contratos->baja_contrato = 'Nulo';
//        }
//        dd($caracteristicaComodidades);
//        $pagado =null;

        return view('publicaciones.show',compact('publicacion', 'imagenes', 'ratings', 'solicitud', 'contratos', 'contrato_id'));
//        return view('publicaciones.show',['publicacion'=> $publicacion]);
    }

    public function create(Provincia $provincia, TipoPropiedad $tipoPropiedad, Ciudad $ciudad, Comodidad $comodidad, CaracteristicaComodidad $caracteristicaComodidad)
    {
        $provincias = Provincia::get()->sortBy('nombre_provincia');
        $tiposPropiedad = TipoPropiedad::get();
//        devlver ciudades ordenado por el id de provincia seleccionado
        $ciudades = Ciudad::get()->sortBy('nombre_ciudad');
//        $ciudades = Ciudad::get();
        $comodidades = Comodidad::get();
        $caracteristicasComodidades = CaracteristicaComodidad::get();
        $tipoInquilino = TipoInquilino::get();
//        $publicacion_tipo_inquilino = PublicacionTipoInquilino::get();

        return view('publicaciones.create', compact('provincias', 'tiposPropiedad', 'ciudades', 'comodidades', 'caracteristicasComodidades', 'tipoInquilino'));
//        return to_route('publicaciones.create', compact('provincias', 'tiposPropiedad', 'ciudades', 'comodidades', 'caracteristicasComodidades'))->with('creacion','ok');
    }

//    {
//        $provincias = Provincia::get();
//        return view('publicaciones.create',['provincias'=> $provincias]);
//    }

    public function store(Request $request, Provincia $provincia)
    {
        $request->validate([
            'titulo'=>['required'],
            'descripcion'=>['required'],
            'file'=>['image'],  //| mimes:jpeg,png,jpg,gif,svg
        ]);

        $publicacion = new Publicacion;
        $imageness = new Imagen;
        $imageness2 = new Imagen;
        $imageness3 = new Imagen;
        $imageness4 = new Imagen;
        $imageness5 = new Imagen;



        $publicacion->calle_publicacion = $request->input('calle');
        $publicacion->estado_publicacion = "Activo";
        $publicacion->altura_publicacion = $request->input('altura');
        $publicacion->ambientes_publicacion = $request->input('ambientes');
        $publicacion->dormitorios_publicacion = $request->input('dormitorios');
        $publicacion->banios_publicacion = $request->input('baños');
        $publicacion->cochera_publicacion = $request->input('cocheras');
        $publicacion->superficie_cubierta_casa = $request->input('cubierta');
        $publicacion->superficie_total_terreno = $request->input('total_terreno');
        $publicacion->precio_publicacion = $request->input('precio');
        $publicacion->titulo_publicacion = $request->input('titulo');
        $publicacion->descripcion_publicacion = $request->input('descripcion');
        $publicacion->id_tipo_propiedad = $request->input('tipo_propiedad');
//        $publicacion->id_provincia = $request->input('provincia');
        $publicacion->id_ciudad = $request->input('ciudad');
        $publicacion->longitud_publicacion = $request->input('longitud');
        $publicacion->latitud_publicacion = $request->input('latitud');
//        obtener el usuario logueado
        $publicacion->id_usuario = auth()->user()-> getAuthIdentifier();




        //Se obtiene la imagen
        //Si la imagen no es nula, se guarda en la carpeta public/images y se crea la variable
        if($request->hasFile('file')){
            $imagenes = $request->file('file')->store('public/imagenes');
        }
        if($request->hasFile('file1')){
            $imagenes1 = $request->file('file1')->store('public/imagenes');
        }
        if($request->hasFile('file2')){
            $imagenes2 = $request->file('file2')->store('public/imagenes');
        }
        if($request->hasFile('file3')){
            $imagenes3 = $request->file('file3')->store('public/imagenes');
        }
        if($request->hasFile('file4')){
            $imagenes4 = $request->file('file4')->store('public/imagenes');
        }

        $publicacion->save();
        $publicacion->caracteristica_comodidades()->attach($request->input('caracteristicas'));
        //almacenar los tipos de inquilinos
        $publicacion->publicacion_tipo_inquilino()->attach($request->input('inquilinos'));

//        $publicacion->id_tipo_inquilino = $request->input('inquilinos');



        //Se guarda las imagenes en la tabla imagenes despues que se creo la publicacion

        if(isset($imagenes)){
                $url = Storage::url($imagenes);
                $imageness->url_imagen = $url;
                $imageness->id_publicacion = $publicacion->id;
                $imageness->save();
        }
        if(isset($imagenes1)){
            $url1 = Storage::url($imagenes1);
            $imageness2->url_imagen = $url1;
            $imageness2->id_publicacion = $publicacion->id;
            $imageness2->save();
        }

        if(isset($imagenes2)){
            $url2 = Storage::url($imagenes2);
            $imageness3->url_imagen = $url2;
            $imageness3->id_publicacion = $publicacion->id;
            $imageness3->save();
        }

        if(isset($imagenes3)){
            $url3 = Storage::url($imagenes3);
            $imageness4->url_imagen = $url3;
            $imageness4->id_publicacion = $publicacion->id;
            $imageness4->save();
        }

//        $imageness->save();

        if(isset($imagenes4)){
            $url4 = Storage::url($imagenes4);
            $imageness5->url_imagen = $url4;
            $imageness5->id_publicacion = $publicacion->id;
            $imageness5->save();
        }

        session()->flash('estado_publicacion','Se publico de manera exitosa la Propiedad');

        return to_route('publicaciones.index')->with('creacion','ok');
    }

    public function edit(Publicacion $publicacion, Provincia $provincia, TipoPropiedad $tipoPropiedad, Ciudad $ciudad, Comodidad $comodidad, CaracteristicaComodidad $caracteristicaComodidad)
    {
        $provincias = Provincia::get();
        $tiposPropiedad = TipoPropiedad::get();
        $ciudades = Ciudad::get();
        $comodidades = Comodidad::get();
        $caracteristicasComodidades = CaracteristicaComodidad::get();
        $imagenes = Imagen::get();

        return view('publicaciones.edit', compact('publicacion', 'provincias', 'tiposPropiedad', 'ciudades', 'comodidades', 'caracteristicasComodidades', 'imagenes'));
    }




    public function update(Request $request, Publicacion $publicacion)
    {
        $request->validate([
            'titulo'=>['required'],
            'descripcion'=>['required'],
        ]);
        $imagenes = Imagen::get();

        //$publicacion = Publicacion::find($publicacion); Funciona igual porque tenemos  Publicacion $publicacion como segundo parametro
        //Pagina 1 del formulario
        //$publicacion->tipo_propiedad = $request->input('tipo_propiedad');
        //$publicacion->subtipo_propiedad = $request->input('subtipo_propiedad');
        //Pagina 2 del formulario
        //$publicacion->direccion_propiedad = $request->input('direccion');
        //$publicacion->provincia_propiedad = $request->input('provincia');
        //$publicacion->ciudad_propiedad = $request->input('ciudad');
        //Falta Ubicacion

        //Pagina 3 del formulario
        $publicacion->ambientes_publicacion = $request->input('ambientes');
        $publicacion->calle_publicacion = $request->input('calle');
        $publicacion->altura_publicacion = $request->input('altura');
        $publicacion->dormitorios_publicacion = $request->input('dormitorios');
        $publicacion->banios_publicacion = $request->input('baños');
        $publicacion->cochera_publicacion = $request->input('cocheras');
        $publicacion->superficie_cubierta_casa = $request->input('cubierta');
        $publicacion->superficie_total_terreno = $request->input('total_terreno');
        $publicacion->precio_publicacion = $request->input('precio');
        $publicacion->titulo_publicacion = $request->input('titulo');
        $publicacion->descripcion_publicacion = $request->input('descripcion');
        $publicacion->id_provincia = $request->input('provincia');
        $publicacion->id_ciudad = $request->input('ciudad');
        $publicacion->id_tipo_propiedad = $request->input('tipo_propiedad');
//        si longi y lati no estan vacios
        if($request->input('longitud') != null && $request->input('latitud') != null){
            $publicacion->longitud_publicacion = $request->input('longitud');
            $publicacion->latitud_publicacion = $request->input('latitud');
        }
        $publicacion->caracteristica_comodidades()->sync($request->input('caracteristicas'));

//        $publicacion->id_provincia = $request->input('provincia');
        //Pagina 4 del formulario
        //Falta imagen


        $publicacion->save();

//        actualizar las imagenes
        $imagenes = $request->file('file')->store('public/imagenes');
        $imagenes1 = $request->file('file1')->store('public/imagenes');
        $imagenes2 = $request->file('file2')->store('public/imagenes');
        $imagenes3 = $request->file('file3')->store('public/imagenes');
        $imagenes4 = $request->file('file4')->store('public/imagenes');

        $url = Storage::url($imagenes);
        $url1 = Storage::url($imagenes1);
        $url2 = Storage::url($imagenes2);
        $url3 = Storage::url($imagenes3);
        $url4 = Storage::url($imagenes4);

        $imagen = Imagen::where('id_publicacion', $publicacion->id)->first();
        $imagen->url_imagen = $url;
        $imagen->save();

        //return to_route('publicaciones.index');
        return to_route('publicaciones.index',$publicacion)->with('modificar','ok');
    }

    public function destroy(Request $request, Publicacion $publicacion)
    {
        //cambiar el valor de estado de activo a descativado
//        $publicacion->estado_publicacion = 0;
        $publicacion->estado_publicacion = "Desactivado";
        $publicacion->save();
        $publicacion->delete();

        return to_route('publicaciones.index')->with('deshabilitar','ok');
    }

    public function borrado()
    {
        $publicaciones = Publicacion::onlyTrashed()->get();

        return view('admin.publicaciones.borradores',['publicaciones'=> $publicaciones]);
    }

    public function borradoUsuario()
    {
        $publicaciones = Publicacion::onlyTrashed()->get();
        $tiposPropiedades = TipoPropiedad::get();
        $imagenes = Imagen::get();

        return view('publicaciones.borradores.borradores',['publicaciones'=> $publicaciones, 'tiposPropiedades' => $tiposPropiedades, 'imagenes' => $imagenes])->with('borradousuario','ok');
//        return view('publicaciones.borradores.borradores',['publicaciones'=> $publicaciones,'tiposPropiedades' => $tiposPropiedades]);
//        return to_route('publicaciones.borradores.borradores',compact[$publicaciones,$tiposPropiedades,$imagenes])->with('borradousuario','ok');
    }

    public function eliminarPublicacionesBasura($id)
    {
        $publicaciones = Publicacion::onlyTrashed()->findOrFail($id);
        $publicaciones->forceDelete();
        return to_route('publicaciones.index')->with('publicacionbasura','ok');
        //Esta ruta tiene que cambiarse para que te lleve a la parte de adminLTE
    }

    public function restaurarPublicacion($id)
    {
        $publicaciones = Publicacion::onlyTrashed()->findOrFail($id);
        $publicaciones->estado_publicacion ='Activo';
//        $publicaciones->save();
        $publicaciones->restore();

        return to_route('publicaciones.index')->with('restaurar','ok');
    }

}
