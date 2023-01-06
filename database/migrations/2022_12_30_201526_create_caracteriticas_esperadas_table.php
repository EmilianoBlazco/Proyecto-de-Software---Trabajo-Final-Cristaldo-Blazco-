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
        Schema::create('caracteriticas_esperadas', function (Blueprint $table) {
            $table->id();

            $table->string('estado_respuesta')->nullable();
//            $table->string('calle_respuesta_1')->nullable();
//            $table->string('calle_respuesta_2')->nullable();
//            $table->string('calle_respuesta_3')->nullable();
            $table->integer('ambientes_respuesta')->nullable();
            $table->integer('dormitorios_respuesta')->nullable();
            $table->integer('banios_respuesta')->nullable();
            $table->integer('cochera_respuesta')->nullable();
            $table->double('precio_respuesta_minimo')->nullable();
            $table->double('precio_respuesta_maximo')->nullable();

            $table->timestamps();
        });

        //crear tabla comodidad_respuesta
        Schema::create('comodidad_respuesta', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('tipo_inquilino_respuesta', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('tipo_propiedad_respuesta', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::table('caracteriticas_esperadas', function (Blueprint $table) {
            $table->foreignId('id_usuario')->constrained('users');
        });

        Schema::table('comodidad_respuesta', function (Blueprint $table) {
            $table->foreignId('id_caracteriticas_esperadas')->constrained('caracteriticas_esperadas');
            $table->foreignId('id_caracteristica_comodidad')->constrained('caracteristica_comodidad');
        });

        Schema::table('tipo_inquilino_respuesta', function (Blueprint $table) {
            $table->foreignId('id_caracteriticas_esperadas')->constrained('caracteriticas_esperadas');
            $table->foreignId('id_tipo_inquilino')->constrained('tipo_inquilino');
        });

        Schema::table('tipo_propiedad_respuesta', function (Blueprint $table) {
            $table->foreignId('id_caracteriticas_esperadas')->constrained('caracteriticas_esperadas');
            $table->foreignId('id_tipo_propiedad')->constrained('tipo_propiedad');
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caracteriticas_esperadas');
    }
};
