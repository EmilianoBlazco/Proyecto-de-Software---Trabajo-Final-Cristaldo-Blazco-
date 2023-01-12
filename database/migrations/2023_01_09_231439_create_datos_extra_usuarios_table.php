<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_extra_usuarios', function (Blueprint $table) {
            $table->id();

            $table->string('domicilio_calle');
            $table->string('domicilio_altura');
            $table->string('dni');
            $table->string('cuit');

            $table->timestamps();
        });

        Schema::table('datos_extra_usuarios', function (Blueprint $table) {
            $table->foreignId('id_usuario')->nullable()->constrained('users');
            $table->foreignId('id_ciudad')->nullable()->constrained('ciudad');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_extra_usuarios');
    }
};
