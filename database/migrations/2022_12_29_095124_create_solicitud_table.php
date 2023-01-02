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
        Schema::create('solicitud', function (Blueprint $table) {
            $table->id();

            $table->string('estado_solicitud')->default('Pendiente');

            $table->timestamps();
        });

        Schema::table('solicitud', function (Blueprint $table) {
            $table->foreignId('id_publicacion')->constrained('publicacion');
            $table->foreignId('id_usuario')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud');
    }
};
