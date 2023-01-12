<?php

namespace Database\Seeders;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinciasCiudades extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        crear todas las provincias y ciudades de argentina
//        (1, 'Buenos Aires'),
//        (2, 'Buenos Aires-GBA'),
//        (3, 'Capital Federal'),
//        (4, 'Catamarca'),
//        (5, 'Chaco'),
//        (6, 'Chubut'),
//        (7, 'Córdoba'),
//        (8, 'Corrientes'),
//        (9, 'Entre Ríos'),
//        (10, 'Formosa'),
//        (11, 'Jujuy'),
//        (12, 'La Pampa'),
//        (13, 'La Rioja'),
//        (14, 'Mendoza'),
//        (15, 'Misiones'),
//        (16, 'Neuquén'),
//        (17, 'Río Negro'),
//        (18, 'Salta'),
//        (19, 'San Juan'),
//        (20, 'San Luis'),
//        (21, 'Santa Cruz'),
//        (22, 'Santa Fe'),
//        (23, 'Santiago del Estero'),
//        (24, 'Tierra del Fuego'),
//        (25, 'Tucumán');

        $provincias = [
            'Buenos Aires',
            'Buenos Aires-GBA',
            'Capital Federal',
            'Catamarca',
            'Chaco',
            'Chubut',
            'Córdoba',
            'Corrientes',
            'Entre Ríos',
            'Formosa',
            'Jujuy',
            'La Pampa',
            'La Rioja',
            'Mendoza',
            'Misiones',
            'Neuquén',
            'Rio Negro',
            'Salta',
            'San Juan',
            'San Luis',
            'Santa Cruz',
            'Santa Fe',
            'Santiago del Estero',
            'Tierra del Fuego',
            'Tucumán'
        ];

        foreach ($provincias as $provincia) {
            \App\Models\Provincia::create([
                'nombre_provincia' => $provincia,
            ]);
        }

//        crear todas las ciudades de misiones argentina

        $ciudades = [
            'Posadas',
            'Puerto Iguazú',
            'San Ignacio',
            'San Pedro',
            'San Vicente',
            'Wanda',
            'Aguapey',
            'Alba Posse',
            'Almafuerte',
            'Apóstoles',
            'Aristóbulo del Valle',
            'Arroyo del Medio',
            'Azara',
            'Barranqueras',
            'Basail',
            'Bernardo de Irigoyen',
            'Bonpland',
            'Caá Catí',
            'Campo Grande',
            'Campo Ramón',
            'Campo Viera',
            'Candelaria',
            'Capioví',
            'Caraguatay',
            'Cd. de Garay',
            'Cerro Azul',
            'Cerro Corá',
            'Colonia Alberdi',
            'Colonia Aurora',
            'Colonia Delicia',
            'Colonia Polana',
            'Colonia Victoria',
            'Colonia Wanda',
            'Concepción de la Sierra',
            'Corpus',
            'Dos Arroyos',
            'Dos de Mayo',
            'El Alcázar',
            'El Soberbio',
            'Esperanza',
            'Fachinal',
            'Garuhapé',
            'Garupá',
            'Gral. Alvear',
            'Gral. Urquiza',
            'Gral. Vedia',
            'Guaraní',
            'Hohenau',
            'Iguazú',
            'Itacaruaré',
            'Jardín América',
            'Leandro N. Alem',
            'Libertad',
            'Loreto',
            'Los Helechos',
            'Mártires',
            'Montecarlo',
            'Oberá',
            'Olegario V. Andrade',
            'Panambí',
            'Posadas',
            'Profundidad',
            'Pto. Iguazú',
            'Pto. Leoni',
            'Pto. Piray',
            'Pto. Rico',
            'Ruiz de Montoya',
            'San Antonio',
            'San Ignacio',
            'San Javier',
            'San José',
            'San Martín',
            'San Pedro',
            'San Vicente',
            'Santiago de Liniers',
            'Santo Pipo',
            'Sta. Ana',
            'Sta. María',
            'Tres Capones',
            'Veinticinco de Mayo',
            'Wanda',
        ];

//        modificar los datos del array de ciudad con su provincia correspondiente
        foreach ($ciudades as $ciudad) {
            \App\Models\Ciudad::create([
                'nombre_ciudad' => $ciudad,
                'id_provincia' => 15,
            ]);
        }

//        foreach ($ciudades as $ciudad) {
//            \App\Models\Ciudad::create([
//                'nombre_ciudad' => $ciudad
//            ]);
//        }

//        agregar los tipos de propiedades
//    - Casa
//    - Departamento
//    - Campo

        $tipos_propiedades = [
            'Casa',
            'Departamento',
            'Campo'
        ];

        foreach ($tipos_propiedades as $tipo_propiedad) {
            \App\Models\TipoPropiedad::create([
                'nombre_tipo_propiedad' => $tipo_propiedad
            ]);
        }
    }
}
