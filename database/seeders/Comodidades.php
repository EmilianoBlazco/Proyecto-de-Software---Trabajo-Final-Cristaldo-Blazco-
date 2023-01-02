<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class Comodidades extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        insertar las siguientes comodidades en la tabla comodidad y en la tabla caracteristica_comodidad
//        - Accesibliidad
//          . Acceso para personas con discapacidad
//          . Permiten mascotas
//        - Servicios
//          . Ascensor
//          . Internet/Wifi
//          . Lavanderia
//          . Servicio de limpieza
//        - Caracteristicas
//          . Aire acondicionado
//          . Amoblado
//          . Calefaccion
//          . Cocina equipada
//          . Lavarropas
//          . Termotanque
//          . Vigilancia
//        - Ambientes
//          . Balcon
//          . Cocina
//          . Comedor
//          . Hall
//          . Jardin
//          . Lavadero
//          . Living
//          . Living comedor
//          . Patio
//          . Sotano
//          . Terraza

//        Crear solamente las comodidades y no las caracteristicas

        $comodidades = [
            'Accesibilidad',
            'Servicios',
            'Caracteristicas',
            'Ambientes',
        ];

        foreach ($comodidades as $comodidad) {
            \App\Models\Comodidad::create([
                'nombre_comodidad' => $comodidad,
            ]);
        }

//        crear las caracteristicas de las comodidades
        $caracteristicas = [
            'Accesibilidad' => [
                'Acceso para personas con discapacidad',
                'Permiten mascotas',
            ],
            'Servicios' => [
                'Ascensor',
                'Internet/Wifi',
                'Lavanderia',
                'Servicio de limpieza',
                'Luz',
                'Agua',
            ],
            'Caracteristicas' => [
                'Aire acondicionado',
                'Amoblado',
                'Calefaccion',
                'Cocina equipada',
                'Lavarropas',
                'Termotanque',
                'Vigilancia',
            ],
            'Ambientes' => [
                'Balcon',
                'Cocina',
                'Comedor',
                'Hall',
                'Jardin',
                'Lavadero',
                'Living',
                'Living comedor',
                'Patio',
                'Sotano',
                'Terraza',
            ],
        ];

        foreach ($caracteristicas as $comodidad => $caracteristica) {
            foreach ($caracteristica as $caracteristica) {
                \App\Models\CaracteristicaComodidad::create([
                    'nombre_caracteristica_comodidad' => $caracteristica,
                    'id_comodidad' => \App\Models\Comodidad::where('nombre_comodidad', $comodidad)->first()->id,
                ]);
            }
        }
    }
}
