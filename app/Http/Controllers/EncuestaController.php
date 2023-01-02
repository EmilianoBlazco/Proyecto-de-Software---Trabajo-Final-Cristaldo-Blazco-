<?php

namespace App\Http\Controllers;

use App\Models\CaracteristicaEsperada;
use Illuminate\Http\Request;

class EncuestaController extends Controller
{

    public function store(Request $request)
    {
        $encuesta = new CaracteristicaEsperada();
        $encuesta->estado_respuesta = 'Respondido';
        $encuesta->calle_respuesta_1 = $request->input('calle1');
        $encuesta->calle_respuesta_2 = $request->input('calle2');
        $encuesta->calle_respuesta_3 = $request->input('calle3');
        $encuesta->ambientes_respuesta = $request->input('ambientes');
        $encuesta->dormitorios_respuesta = $request->input('dormitorios');
        $encuesta->banios_respuesta = $request->input('banios');
        $encuesta->cochera_respuesta = $request->input('cocheras');
        $encuesta->precio_respuesta_minimo = $request->input('preciomin');
        $encuesta->precio_respuesta_maximo = $request->input('preciomax');
        $encuesta->id_usuario = auth()->user()->id;
        $encuesta->save();

        $encuesta->caracteristica_comodidad()->attach($request->input('caracteristicas'));
        $encuesta->tipo_propiedad()->attach($request->input('propiedades'));
        $encuesta->tipo_inquilino()->attach($request->input('inquilinos'));

        return redirect()->route('dashboard')->with('success', 'Encuesta enviada con éxito');
    }
}
