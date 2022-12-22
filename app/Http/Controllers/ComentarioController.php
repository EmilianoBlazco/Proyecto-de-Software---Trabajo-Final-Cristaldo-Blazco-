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
        //CAMBIAR EL ESTADO DEL COMENTARIO DE 0 A 1 Y DE 1 A 0
//        $comentario = Comentario::findOrFail($id);
//        $comentario->estado_comentario = $request->estado_comentario;
//        $comentario->save();
//        return redirect()->back();
        $comentario = Comentario::findorFail($id);
//        dd($comentario);
//        $comentario->estado_comentario = $request->estado_comentario;
        if($comentario->estado_comentario == 1){
            $comentario->estado_comentario = 0;
        }elseif($comentario->estado_comentario == 0){
            $comentario->estado_comentario = 1;
        }
        $comentario->save();
        return redirect()->back();
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
