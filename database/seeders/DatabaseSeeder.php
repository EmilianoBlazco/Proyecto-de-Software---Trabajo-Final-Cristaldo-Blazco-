<?php

namespace Database\Seeders;

 use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
 use Laravel\Jetstream\Role;

 class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

//
//        llamar a todos los seeders
$this->call([
    UserSeeder::class,
    RoleSeeder::class,
    Comodidades::class,
    ProvinciasCiudades::class,
    SeederGeneral::class,
]);


    }
}
