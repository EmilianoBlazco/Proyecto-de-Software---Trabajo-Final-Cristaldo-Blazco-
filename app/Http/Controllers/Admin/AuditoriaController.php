<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDFS;

class AuditoriaController extends Controller
{
    public function index()
    {
        $auditorias = Audit::get();
        $usuarios = User::get();
        return view('auditoria',compact('auditorias','usuarios'));
    }

    public function show(Audit $auditoria)
    {
//        $usuarios = User::get();
//        $usuario = User::find($auditorias->user_id);

//        $auditorias = Audit::find($auditorias->id);
//        $auditorias = Audit::find(1);

        $prueba = Audit::find($auditoria->user_type);

        return view('auditoriamas',compact('auditoria','prueba'));
    }
//    {
//        $auditorias = Audit::find($request);
//        return view('auditoriamas',compact('auditorias'));
//    }

    public function pdf()
    {
        $auditorias = Audit::get();
        $pdf = PDFS\Pdf::loadView('pdfmostrar', ['auditorias'=>$auditorias]);//,'usuarios'=>$usuarios]);
        return $pdf->stream();
    }
    public function pdfmas()
    {
        $auditoriamas = Audit::get();
        $pdf = PDFS\Pdf::loadView('pdfmostrarmas', ['auditoriamas'=>$auditoriamas]);
        return $pdf->stream();
    }
//    {
//        $users = User::all();
//        $pdf = PDFS\Pdf::loadView('admin.users.pdfmostrar', ['users'=>$users]);
//        return $pdf->stream();
//    }
}
