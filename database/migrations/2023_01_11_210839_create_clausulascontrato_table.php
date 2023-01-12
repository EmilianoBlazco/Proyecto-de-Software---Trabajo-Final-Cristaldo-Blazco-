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
        Schema::create('clausulas_contrato', function (Blueprint $table) {
            $table->id();

            $table->longText('clausula');

            $table->timestamps();
        });

//        relacion con contrato
        Schema::table('clausulas_contrato', function (Blueprint $table) {
            $table->foreignId('id_clausula')->constrained('contrato');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clausulascontrato');
    }
};
