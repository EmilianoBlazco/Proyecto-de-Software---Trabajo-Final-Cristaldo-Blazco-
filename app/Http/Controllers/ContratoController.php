<?php

namespace App\Http\Controllers;

use App\Models\CaracteristicaComodidad;
use App\Models\Ciudad;
use App\Models\ClausulasContrato;
use App\Models\Comodidad;
use App\Models\Contrato;
use App\Models\DatosExtraUsuarios;
use App\Models\Imagen;
use App\Models\Provincia;
use App\Models\Publicacion;
use App\Models\TipoInquilino;
use App\Models\TipoPropiedad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Luecano\NumeroALetras\NumeroALetras;
use App\NumerosEnLetras;

class ContratoController extends Controller
{

    public function index()
    {
        $contratos = Contrato::all()->where('id_usuario',Auth::user()->id);

        return view('contratos.index', compact('contratos'));
    }

    public function create()
    {
        $publicaciones = Publicacion::get()->where('id_usuario',auth()->user()->id);
        $usuarios = User::all();

        //traer todos los usuarios que posean una solicitud para la publicacion

        return view('contratos.create', compact('publicaciones', 'usuarios'));
    }

    public function store(Request $request)
    {
        $contratos = Contrato::all()->where('id_usuario',Auth::user()->id);

        $publicacion = Publicacion::find($request->id_pub);
//        dd($publicacion->titulo_publicacion .' contrato');
        $contrato = new Contrato();
        $contrato->titulo_contrato = $publicacion->titulo_publicacion . ' contrato';
//        $contrato->descripcion_contrato = $request->condiciones;
        $contrato->tipo_contrato = 1; //definido por el usuario
        $contrato->monto_contrato = $publicacion->precio_publicacion;
        $contrato->fecha_inicial_pago_contrato = $request->fechaInicio;
        $contrato->fecha_final_pago_contrato = $request->fechaFin;
        $contrato->porcentaje_aumento_contrato_restraso = $request->recargoDias;
        $contrato->periodo_aumento_contrato = $request->meses;
        $contrato->porcentaje_aumento_contrato = $request->recargoMeses;
        $contrato->retraso_maximo_pago_contrato = $request->cuotas;
        $contrato->id_publicacion = $request->id_pub;
        $contrato->fecha_inicio_contrato = $request->celebracion;
        $contrato->fecha_vencimiento_contrato = $request->vencimiento;
        $contrato->id_usuario = Auth::user()->id;
        $contrato->id_inquilino = $request->id_inq;
        $contrato->confirmacion_inquilino = 0;
        $contrato->confirmacion_propietario = 1;


        $contrato->save();

//        guardar los campos de clausulas
//        recorrer los campos de clausulas y guardarlos en la tabla clausulas con el name="clausulaX" x va de 1 a 10
        for ($i = 1; $i <= 10; $i++) {
            if ($request->input('clausula' . $i) != null) {
                $clausula = new ClausulasContrato();
                $clausula->clausula = $request->input('clausula' . $i);
                $clausula->id_clausula = $contrato->id;
                $clausula->save();
            }
        }
        dd($request->all());


        return redirect()->route('contratos.index')->with('contrato', 'ok');
    }

    public function show($id)
    {
        $contrato = Contrato::find($id);
//        dd($contrato);
        $publicacion = Publicacion::find($contrato->id_publicacion);
        $ciudad = Ciudad::find($publicacion->id_ciudad);
        $provincia = Provincia::find($ciudad->id_provincia);
        $propietario = User::find($publicacion->id_usuario);
        $inquilino = User::find($contrato->id_inquilino);
        $tipoPropiedad = TipoPropiedad::find($publicacion->id_tipo_propiedad);
        $tipoInquilino = TipoInquilino::find($publicacion->id_tipo_inquilino);
        $imagenes = Imagen::get()->where('id_publicacion', $publicacion->id);
        $datospropietario = DatosExtraUsuarios::get()->where('id_usuario', $propietario->id)->first();
        $datosinquilino = DatosExtraUsuarios::get()->where('id_usuario', $propietario->id)->first();
        $ciudadpropietario = Ciudad::find($datospropietario->id_ciudad);
        $provinciapropietario = Provincia::find($ciudadpropietario->id_provincia);
        $ciudadinquilino = Ciudad::find($datosinquilino->id_ciudad);
        $provinciainquilino = Provincia::find($ciudadinquilino->id_provincia);

        //numeros a letras
        $valor_total = NumerosEnLetras::convertir((12 * $contrato->monto_contrato));
        $periodo_aumento = NumerosEnLetras::convertir($contrato->periodo_aumento_contrato);
        $monto_original = NumerosEnLetras::convertir($contrato->monto_contrato);
        $monto_aumento = NumerosEnLetras::convertir($contrato->periodo_aumento_contrato);
        $fecha_inicio =  NumerosEnLetras::convertir($contrato->fecha_inicial_pago_contrato);
        $fecha_final =  NumerosEnLetras::convertir($contrato->fecha_final_pago_contrato);

        //manejo de fechas
//       diferencia entre fechas
        $fechaInicio = Carbon::parse($contrato->fecha_inicio_contrato);
        $fechaFin = Carbon::parse($contrato->fecha_vencimiento_contrato);
        $diferencia_num = $fechaInicio->diffInMonths($fechaFin);
        $diferencia_letra = NumerosEnLetras::convertir($diferencia_num);
        //fecha en formato dd/mm/aaaa escrito y traducido al español



//        dd($ciudadpropietario, $provinciapropietario, $ciudadinquilino, $provinciainquilino);

        return view('contratos.show', compact('contrato', 'publicacion', 'provincia', 'ciudad', 'propietario',
                    'tipoPropiedad','imagenes','tipoInquilino','inquilino','datospropietario','datosinquilino','ciudadpropietario',
                    'provinciapropietario','ciudadinquilino','provinciainquilino','periodo_aumento','monto_original','fecha_inicio',
                    'fecha_final','valor_total','monto_aumento','diferencia_num','diferencia_letra'));
    }

    public function edit($id)
    {
        $contrato = Contrato::find($id);
        $publicaciones = Publicacion::get()->where('id',$contrato->id_publicacion)->first();
//        dd($publicaciones);;
        $propietario = User::get()->where('id',$contrato->id_usuario)->first();
        $inquilino = User::get()->where('id',$contrato->id_inquilino)->first();
        return view('contratos.edit', compact('contrato', 'publicaciones', 'propietario', 'inquilino'));
    }

    public function update(Request $request,  $id)
    {
        if($request->bandera == 'flag'){
            $contrato = Contrato::find($id);
            $contrato->confirmacion_inquilino = 1;
            $contrato->save();

            return redirect()->route('contratos.show',$contrato)->with('contrato', 'ok');
        }else{
            $contrato = Contrato::find($id);

            $contrato->descripcion_contrato = $request->input('condiciones');
            $contrato->tipo_contrato = 1; //definido por el usuario
            $contrato->fecha_inicial_pago_contrato = $request->input('fechaInicio');
            $contrato->fecha_final_pago_contrato = $request->input('fechaFin');
            $contrato->porcentaje_aumento_contrato_restraso = $request->input('recargoDias');
            $contrato->periodo_aumento_contrato = $request->input('meses');
            $contrato->porcentaje_aumento_contrato = $request->input('recargoMeses');
            $contrato->retraso_maximo_pago_contrato = $request->input('cuotas');
            $contrato->fecha_inicio_contrato = $request->input('celebracion');
            $contrato->fecha_vencimiento_contrato = $request->input('vencimiento');

            $contrato->save();

            return redirect()->route('contratos.index')->with('modificacion', 'ok');
        }

    }

    public function destroy($id)
    {
        $contrato = Contrato::find($id);
        $contrato->baja_contrato = now();
        $contrato->save();

        return redirect()->route('contratos.index')->with('baja', 'ok');
    }
}
