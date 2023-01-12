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
        Schema::create('publicacion', function (Blueprint $table) {
            $table->id();

            $table->string('estado_publicacion');
            $table->string('calle_publicacion');
            $table->integer('altura_publicacion');
            $table->integer('dormitorios_publicacion')->nullable();
            $table->integer('banios_publicacion')->nullable();
            $table->integer('cochera_publicacion')->nullable();
            $table->integer('ambientes_publicacion')->nullable();
            $table->double('superficie_cubierta_casa')->nullable();
            $table->double('superficie_total_terreno')->nullable();
            $table->double('precio_publicacion');
            $table->string('titulo_publicacion');
            $table->string('descripcion_publicacion');
            $table->string('longitud_publicacion');
            $table->string('latitud_publicacion');
            $table->integer('id_inquilino')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('publicacion', function (Blueprint $table) {
            $table->foreignId('id_usuario')->constrained('users');
        });

        //crear tabla Tipo de propiedad
        Schema::create('tipo_propiedad', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_tipo_propiedad');
            $table->softDeletes();
            $table->timestamps();
        });
        //crear tabla provincia
        Schema::create('provincia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_provincia');
            $table->softDeletes();
            $table->timestamps();
        });
        //crear tabla localidad
        Schema::create('ciudad', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_ciudad');
            $table->softDeletes();
            $table->timestamps();
        });

        //crear tabla comodidades
        Schema::create('comodidad', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_comodidad');
            $table->softDeletes();
            $table->timestamps();
        });

        //crear tabla imagenes sin clave foranea
        Schema::create('imagen', function (Blueprint $table) {
            $table->id();
            $table->string('url_imagen');
            $table->softDeletes();
            $table->timestamps();
        });

        //crear tabla mercado pago transacciones sin clave foranea
        Schema::create('mercado-pago-transacciones', function (Blueprint $table) {
            $table->id();
            $table->string('numero_transaccion');
            $table->double('monto_transaccion');
            $table->string('estado_transaccion');
            $table->string('metodo_pago');
            $table->string('tipo_pago');
            $table->string('id_usuario');
            $table->string('nombre_usuario');
            $table->softDeletes();
            $table->timestamps();
        });

        //una publicacion tiene muchas imagenes (No es necesaria almenos que queramos hacer una relacion de doble sentido)
//        Schema::table('publicacion', function (Blueprint $table) {
//            $table->foreignId('id_imagen')->constrained('imagen');
//        });

        //una imagen es para una publicacion
        Schema::table('imagen', function (Blueprint $table) {
            $table->foreignId('id_publicacion')->constrained('publicacion');
        });

        //una publicacion tiene muchas transacciones de mercado pago
//        Schema::table('mercado-pago-transacciones', function (Blueprint $table) {
//            $table->foreignId('id_publicacion')->constrained('publicacion');
//        });

        //crear tabla caracteristica_comodidad sin clave foranea
        Schema::create('caracteristica_comodidad', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_caracteristica_comodidad');
            $table->softDeletes();
            $table->timestamps();
        });

//        una comodidad pertenece a muchas caracteristica_comodidad
        Schema::table('caracteristica_comodidad', function (Blueprint $table) {
            $table->foreignId('id_comodidad')->constrained('comodidad');
        });


        //crear clave foreanea de tipo de propiedad
        Schema::table('publicacion', function (Blueprint $table) {
            $table->foreignId('id_tipo_propiedad')->constrained('tipo_propiedad');
        });
        //crear clave foreanea de provincia
        Schema::table('ciudad', function (Blueprint $table) {
            $table->foreignId('id_provincia')->constrained('provincia');
        });
        //crear clave foreanea de ciudad
        Schema::table('publicacion', function (Blueprint $table) {
            $table->foreignId('id_ciudad')->constrained('ciudad');
        });

        Schema::create('caracteristica_comodidad_publicacion', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();
        });

//        una publicacion tiene muchas caracteristica_comodidad_publicacion
        Schema::table('caracteristica_comodidad_publicacion', function (Blueprint $table) {
            $table->foreignId('id_publicacion')->constrained('publicacion');
        });

//        una caracteristica_comodidad tiene muchas caracteristica_comodidad_publicacion
        Schema::table('caracteristica_comodidad_publicacion', function (Blueprint $table) {
            $table->foreignId('id_caracteristica')->constrained('caracteristica_comodidad');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicacion');
    }
};
