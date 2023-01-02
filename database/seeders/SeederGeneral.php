<?php

namespace Database\Seeders;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeederGeneral extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_inquilino = [
            'Estudiante',
            'Adultos mayores(60 años en adelante)',
            'Adultos(27 a 59 años)',
            'Jóvenes(18 a 26 años)',
            'Familia',
            'Pareja',
            'Persona con discapacidad',
//            'Otro',
        ];

        foreach ($tipo_inquilino as $tipo) {
            \App\Models\TipoInquilino::create([
                'nombre_tipo_inquilino' => $tipo,
            ]);
        }


//        foreach ($tipo_inquilino as $tipo_propiedad) {
//            \App\Models\TipoPropiedad::create([
//                'nombre_tipo_propiedad' => $tipo_propiedad
//            ]);
//        }
    }
}
