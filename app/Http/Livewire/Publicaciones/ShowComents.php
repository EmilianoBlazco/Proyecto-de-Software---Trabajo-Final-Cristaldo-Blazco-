<?php

namespace App\Http\Livewire\Publicaciones;

use Livewire\Component;

class ShowComents extends Component
{
    public function render()
    {
//        $comentarios = Comentario::where('publicacion_id', $id)->get();
//        $usuario = User::all();
//        return view('publicaciones.show', compact('comentarios', 'usuario'));

        return view('livewire.publicaciones.show-coments');
    }
}
