<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
class RatingController extends Controller
{

    public function index(Publicacion $publicacion)
    {
        $ratings = Rating::all()->where('publicacion_id', $publicacion->id)->where('estado', 1);
        $usuarios = User::all();
//        dd($ratings);
        return view('admin.publicaciones.rating', compact('ratings', 'publicacion', 'usuarios'));
    }

    public function store(Request $request)
    {
//        dd($request);
        $rating = new Rating();
        $rating->calificacion = $request->rate;
        $rating->id_publicacion = $request->id_publicacion;
        $rating->id_usuario = $request->id_usuario;
        $rating->comentario = $request->comentario;
        $rating->save();
        return redirect()->back();
    }

    public function update(Rating $ratings,Request $request)
    {
//        dd($request);
        $ratings->calificacion = $request->rating;
        $ratings->comentario = $request->comentario;
        $ratings->estado = 0;
        $ratings->id_usuario = $request->usuario_id;//ver porque no funciona
        $ratings->id_publicacion = $request->publicacion_id;
        $ratings->save();
        return view('admin.publicaciones.rating',$ratings);
    }

    public function promedio(Publicacion $publicacion)
    {
        $promedio = Rating::where('id_publicacion', $publicacion->id)->avg('calificacion');
        return $promedio;
    }
}
