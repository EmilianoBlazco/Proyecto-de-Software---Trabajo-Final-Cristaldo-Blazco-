<?php

namespace App\Http\Controllers;
use App\Models\CaracteristicaComodidad;
use App\Models\Ciudad;
use App\Models\Comodidad;
use App\Models\Provincia;
//use App\Models\PublicacionTipoInquilino;
use App\Models\TipoInquilino;
use App\Models\TipoPropiedad;

class PruebaController
{
    public function index()
    {
        $tiposPropiedad = TipoPropiedad::get();
        $comodidades = Comodidad::get();
        $caracteristicasComodidades = CaracteristicaComodidad::get();
        $tipoInquilino = TipoInquilino::get();

        return view('pruebaModal', compact('tiposPropiedad', 'comodidades', 'caracteristicasComodidades', 'tipoInquilino'));
    }

}
