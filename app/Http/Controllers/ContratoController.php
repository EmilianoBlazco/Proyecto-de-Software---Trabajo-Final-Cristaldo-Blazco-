<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Http\Request;

class ContratoController extends Controller
{

    public function index()
    {
        $contratos = Contrato::all();
        return view('contratos.index', compact('contratos'));
    }

    public function create()
    {
        $publicaciones = Publicacion::all();
        $users = User::all();
        return view('contratos.create', compact('publicaciones', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_publicacion' => 'required',
            'id_usuario' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'monto' => 'required',
            'porcentaje_aumento' => 'required',
            'periodo_aumento' => 'required',
            'intervalo_pago' => 'required',
            'restraso_maximo' => 'required',
            'estado_contrato' => 'required',
        ]);

        $contrato = new Contrato([
            'id_publicacion' => $request->get('id_publicacion'),
            'id_usuario' => $request->get('id_usuario'),
            'fecha_inicio' => $request->get('fecha_inicio'),
            'fecha_fin' => $request->get('fecha_fin'),
            'monto' => $request->get('monto'),
            'porcentaje_aumento' => $request->get('porcentaje_aumento'),
            'periodo_aumento' => $request->get('periodo_aumento'),
            'intervalo_pago' => $request->get('intervalo_pago'),
            'restraso_maximo' => $request->get('restraso_maximo'),
            'estado_contrato' => $request->get('estado_contrato'),
        ]);
        $contrato->save();
        return redirect('/contratos')->with('success', 'Contrato guardado!');
    }

    public function show($id)
    {
        $contrato = Contrato::find($id);
        return view('contratos.show', compact('contrato'));
    }

    public function edit($id)
    {
        $contrato = Contrato::find($id);
        $publicaciones = Publicacion::all();
        $users = User::all();
        return view('contratos.edit', compact('contrato', 'publicaciones', 'users'));
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'id_publicacion' => 'required',
            'id_usuario' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'monto' => 'required',
            'porcentaje_aumento' => 'required',
            'periodo_aumento' => 'required',
            'intervalo_pago' => 'required',
            'restraso_maximo' => 'required',
            'estado_contrato' => 'required',
        ]);

        $contrato = Contrato::find($id);
        $contrato->id_publicacion = $request->get('id_publicacion');
        $contrato->id_usuario = $request->get('id_usuario');
        $contrato->fecha_inicio = $request->get('fecha_inicio');
        $contrato->fecha_fin = $request->get('fecha_fin');
        $contrato->monto = $request->get('monto');
        $contrato->porcentaje_aumento = $request->get('porcentaje_aumento');
        $contrato->periodo_aumento = $request->get('periodo_aumento');
        $contrato->intervalo_pago = $request->get('intervalo_pago');
        $contrato->restraso_maximo = $request->get('restraso_maximo');
        $contrato->estado_contrato = $request->get('estado_contrato');
        $contrato->save();

        return redirect('/contratos')->with('success', 'Contrato actualizado!');
    }
}
