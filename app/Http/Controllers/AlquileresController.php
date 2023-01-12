<?php

namespace App\Http\Controllers;

use App\Models\DatosExtraUsuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlquileresController extends Controller
{

    public function index()
    {

        $datosExtraUsuarios = DatosExtraUsuarios::get()->where('id_usuario',Auth::user()->id)->first();
        if ($datosExtraUsuarios == null){
            return redirect()->route('datosExtraUsuarios.create')->with('registro','no');
        }else{
            return view('alquileres');
        }

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
