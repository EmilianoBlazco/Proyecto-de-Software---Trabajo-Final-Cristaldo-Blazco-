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
//        Schema::create('publicacion_tipo_inquilino', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
//        });

        Schema::create('publicacion_tipo_inquilino', function (Blueprint $table) {
            $table->id();

//            $table->foreignId('id_publicacion')->constrained('publicacion');
//            $table->foreignId('id_tipo_inquilino')->constrained('tipo_inquilino');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('publicacion_tipo_inquilino', function (Blueprint $table) {
            $table->foreignId('id_publicacion')->constrained('publicacion');
            $table->foreignId('id_tipo_inquilino')->constrained('tipo_inquilino');
        });

//        //una publicaxcion puede tener muchos publicacion_tipo_inquilino
//        Schema::table('publicacion_tipo_inquilino', function (Blueprint $table) {
//            $table->foreignId('id_publicacion')->constrained('publicacion');
//        });
//
//        //un tipo_inquilino puede tener muchos publicacion_tipo_inquilino
//        Schema::table('publicacion_tipo_inquilino', function (Blueprint $table) {
//            $table->foreignId('id_tipo_inquilino')->constrained('tipo_inquilino');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicacion_tipo_inquilino');
    }
};
