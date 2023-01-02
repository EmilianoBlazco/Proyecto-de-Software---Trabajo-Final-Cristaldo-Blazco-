<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        crear un usuario con correo: a@gmail.com y contraseña: 12345678 y rol: Invitado

        \App\Models\User::factory(1)->create([
            'email' => 'a@gmail.com',
            'password' => bcrypt('12345678'),
//            'rol' => 'Admin',
        ]);

        \App\Models\User::factory(1)->create([
            'email' => 'e@gmail.com',
            'password' => bcrypt('12345678'),
//            'rol' => 'Admin',
        ]);

        \App\Models\User::factory(50)->create();
    }
}
