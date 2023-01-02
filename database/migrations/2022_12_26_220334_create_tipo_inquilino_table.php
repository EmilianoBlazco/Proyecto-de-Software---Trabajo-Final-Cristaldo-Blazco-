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
        Schema::create('tipo_inquilino', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_tipo_inquilino');
            $table->softDeletes();

            $table->timestamps();
        });

//        Schema::table('publicacion', function (Blueprint $table) {
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
        Schema::dropIfExists('tipo_inquilino');
    }
};
