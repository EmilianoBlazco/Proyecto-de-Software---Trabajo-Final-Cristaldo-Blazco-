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
        Schema::create('rating', function (Blueprint $table) {
            $table->id();

            $table->integer('calificacion');
            $table->longText('comentario')->nullable();
            $table->boolean('estado')->default(1);

            $table->timestamps();
        });

        Schema::table('rating', function (Blueprint $table) {
            $table->foreignId('id_usuario')->constrained('users');
            $table->foreignId('id_publicacion')->constrained('publicacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rating');
    }
};
