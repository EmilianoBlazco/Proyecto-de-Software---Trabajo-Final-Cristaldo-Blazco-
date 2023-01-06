<?php

namespace App\Http\Controllers;

use App\Mail\AceptarSolicitudMailable;
use App\Mail\RechazarSolicitudMailable;
use App\Mail\SolicitudAlquilerMailable;
use App\Models\Publicacion;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CorreoController extends Controller
{

//    public function indexprop(Request $request)
//    {
////        dd($request);
////        $solicitudes = Publicacion::all()->where('id_usuario', auth()->user()->id)->where('estado_publicacion', 0);
////        dd($solicitudes);
//        $publicacion = Publicacion::all()->where('id', $request->id_publicacion);
//        $usuario = User::all()->where('id', $request->id_solicitante);
////        dd($usuario);
//        $solicitudes = Solicitud::all()->where('estado_solicitud', false)->where('id_publicacion',$request->id_publicacion)->where('id_usuario', $request->id_solicitante);
////        dd($solicitudes);
//        return view('correos.indexProp', compact('solicitudes', 'publicacion', 'usuario'));
//    }

    public function indexprop()
    {
        $publicaciones = Publicacion::all();
        $usuarios = User::all();
//        dd($usuarios);
        $solicitudes = Solicitud::all()->where('estado_solicitud', '=','Pendiente');//->where($usuarios->id, auth()->user()->id);
        return view('correos.indexProp', compact('solicitudes', 'publicaciones', 'usuarios'));
    }

    public function solicitud(Request $request)
    {
        $publicacion = Publicacion::all()->where('id', $request->id_publicacion)->first();
//        dd($request);
        $solicitante = User::all()->where('id', $request->id_usuario)->first();
//        dd($solicitante);
        $usuario = $publicacion->user;
//        dd($usuario);
        //crear una solicitud
        $solicitud = new Solicitud();
        $solicitud->id_publicacion = $publicacion->id;
        $solicitud->id_usuario = $solicitante->id;
        $solicitud->estado_solicitud = 'Pendiente';
        $solicitud->save();

        //enviar correo
        $info = [
            'solicitante' => $solicitante->name,
            'correo_soli' => $solicitante->email,
            'id_solicitante' => $solicitante->id,
            'propietario' => $usuario->name,
            'publicacion' => $publicacion->id,
            'titulo_pub' => $publicacion->titulo_publicacion,
        ];
//        dd($info);
        $correo = new SolicitudAlquilerMailable($info);
//        dd($correo);
        Mail::to($usuario->email)->send($correo);
        return redirect()->route('publicaciones.show', $request->id_publicacion)->with('solicitud', 'ok');
    }


//funcion para cambiar el estado de la solicitud
    public function aceptar(Request $request, Solicitud $id)
    {
//        $respuesta = $request->input('respuesta');
//        dd($request);
        //recuperar en una variable los datos enviados por javascript
        $respuesta = $request->input('respuesta');
//        dd($respuesta);
        if ($respuesta == 'aceptar'){
            $solicitud = Solicitud::find($id);
            $publicacion = Publicacion::find($solicitud->id_publicacion);
            $solicitante = User::all()->where('id', $solicitud->id_usuario)->first();
    //        dd($solicitante);
            $solicitud->estado_solicitud = 'Aceptado';
            $solicitud->save();
            $info = [
                'solicitante' => $solicitante->name,
                'titulo_pub' => $publicacion->titulo_publicacion,
            ];
            $correo = new AceptarSolicitudMailable($info);
            Mail::to($solicitante->email)->send($correo);
            return redirect()->route('correos.index')->with('aceptar', 'ok');
        }elseif ($respuesta == 'rechazar'){
            $solicitud = Solicitud::find($id);
            $publicacion = Publicacion::find($solicitud->id_publicacion);
            $solicitante = User::all()->where('id', $solicitud->id_usuario)->first();
            $solicitud->estado_solicitud = 'Rechazado';
            $solicitud->save();
            $info = [
                'solicitante' => $solicitante->name,
                'titulo_pub' => $publicacion->titulo_publicacion,
            ];
            $correo = new RechazarSolicitudMailable($info);
            Mail::to($solicitante->email)->send($correo);
            return redirect()->route('correos.index')->with('rechazar', 'ok');
        }
    }

    public function rechazar(Request $request, $id)
    {
        $solicitud = Solicitud::find($id);
        $publicacion = Publicacion::find($solicitud->id_publicacion);
        $solicitante = User::all()->where('id', $solicitud->id_usuario)->first();
        $solicitud->estado_solicitud = 'Rechazado';
        $solicitud->save();
        $info = [
            'solicitante' => $solicitante->name,
            'titulo_pub' => $publicacion->titulo_publicacion,
        ];
        $correo = new RechazarSolicitudMailable($info);
        Mail::to($solicitante->email)->send($correo);
        return redirect()->route('correos.index')->with('rechazar', 'ok');
    }
//    {
//        dd($request);
//        $solicitud = Solicitud::all()->where('id_publicacion', $request->id_publicacion)->where('id_usuario', $request->id_usuario)->first();
////        dd($solicitud);
//        $solicitud->estado_solicitud = true;
//        $solicitud->save();
//        return redirect()->route('correos.index')->with('aceptar', 'ok');
//    }
}
