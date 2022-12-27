<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{

    public function index($id)
    {
        $comentarios = Comentario::where('publicacion_id', $id)->get();
        $usuario = User::all();
        return view('publicaciones.show', compact('comentarios', 'usuario'));
    }
//    {
//        $comentarios = Comentario::all()->where('publicacion_id', $publicacion->id);
//        return view('comentarios.index', compact('comentarios'));
//    }

    public function store(Request $request, Publicacion $publicacion)
    {
//        dd($request);
        $comentario = new Comentario();
        $comentario->comentario = $request->descripcion;
        $comentario->estado_comentario = 0;
        $comentario->id_comentario_padre = $request->id_comentario_padre;
//        $comentario->publicacion_id = $publicacion->id;
        $comentario->id_usuario = Auth::user()->id;
        $publicacion->comentario()->save($comentario);

        return redirect()->back();
    }


    public function edit($id)
    {
        $comentario = Comentario::findOrFail($id);
        return view('publicaciones.show', compact('comentario'));
    }


    public function update(Request $request, Comentario $id, Publicacion $idp)
    {
        $comentario = Comentario::findorFail($id);
//        dd($id);

        $publicacion = Publicacion::findorFail($idp);
//        dd($publicacion);
//        dd($comentario);
//        dd($request);
//        $comentario->estado_comentario = $request->estado_comentario;
        if ($comentario->id_publicacion == $publicacion->id){
            $comentario->estado_comentario = 1;
            $comentario->save();
            return redirect()->back();
        }
    }


    public function destroy(Comentario $id_comentario )
    {
        $id_comentario->delete();
        return redirect()->back();
    }
//    {
//
//        $comentario = Comentario::findOrFail($id);
//        $comentario->estado_comentario = 1;
//        $comentario->save();
//        return redirect()->back();
//    }
}
