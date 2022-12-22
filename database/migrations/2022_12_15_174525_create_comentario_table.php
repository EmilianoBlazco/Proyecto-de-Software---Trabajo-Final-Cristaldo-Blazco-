<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('comentario');
            $table->integer('id_comentario_padre')->nullable();
            $table->boolean('estado_comentario');//Activo o descativado

        });

        Schema::table('comentario', function (Blueprint $table) {
            $table->foreignId('id_usuario')->constrained('users');
            $table->foreignId('id_publicacion')->constrained('publicacion');
        });

//        //muchos comentarios es para una publicacion
//        Schema::table('publicacion', function (Blueprint $table) {
//            $table->foreignId('id_comentario')->constrained('comentario');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentario');
    }
};
