<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\DatosExtraUsuarios;
use App\Models\Provincia;
use App\Models\User;
use Illuminate\Http\Request;

class DatosExtraUsuariosController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        $ciudades = Ciudad::all();
        $provincias = Provincia::all();
        $usuario = User::all()->where('id', auth()->user()->id)->first();
//        dd($usuario);

        return view('datosExtraUsuarios.create', compact('ciudades', 'provincias', 'usuario'));
    }


    public function store(Request $request)
    {
//        dd($request->all());
        $datos = new DatosExtraUsuarios();
        $datos->domicilio_calle = $request->calle_dom;
        $datos->domicilio_altura = $request->altura_dom;
        $datos->id_ciudad = $request->ciudad_dom;
        $datos->dni = $request->dni;
        $datos->cuit = $request->cuit;
        $datos->id_usuario = auth()->user()->id;

        $datos->save();

        return redirect()->route('dashboard')->with('registro','ok');
    }


    public function show(DatosExtraUsuarios $datosExtraUsuarios)
    {
        $usuario = User::find($datosExtraUsuarios->id_usuario);

        return view('datosExtraUsuarios.show', compact('datosExtraUsuarios','usuario'));
    }


    public function edit(DatosExtraUsuarios $datosExtraUsuarios)
    {
//        dd($datosExtraUsuarios);
        $usuario = User::find($datosExtraUsuarios->id_usuario);
        $datos = DatosExtraUsuarios::find($datosExtraUsuarios->id);
        $ciudades = Ciudad::all();
        $provincias = Provincia::all();

        return view('datosExtraUsuarios.edit', compact('datosExtraUsuarios','usuario','datos','ciudades','provincias'));

    }


    public function update(Request $request, DatosExtraUsuarios $datosExtraUsuarios)
    {
        $datos = DatosExtraUsuarios::find($datosExtraUsuarios->id);
        $datos->domicilio_calle = $request->calle_dom;
        $datos->domicilio_altura = $request->altura_dom;
        $datos->id_ciudad = $request->ciudad_dom;
        $datos->dni = $request->dni;
        $datos->cuit = $request->cuit;
        $datos->id_usuario = $request->id_usuario;

        $datos->save();

        return redirect()->back()->with('actualizado','ok');

//        return redirect()->route('datosextra.show',$datosExtraUsuarios->id)->with('actualizado','ok');
    }


    public function destroy(DatosExtraUsuarios $datosExtraUsuarios)
    {
        //
    }
}
