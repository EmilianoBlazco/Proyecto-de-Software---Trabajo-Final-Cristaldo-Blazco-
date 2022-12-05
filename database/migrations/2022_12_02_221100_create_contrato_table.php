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
        Schema::create('contrato', function (Blueprint $table) {
            //para tabla general
            $table->id();
//            $table->string('estado_contrato');
            $table->timestamp('baja_contrato');
            $table->boolean('tipo_contrato');//bolean (Con o sin contrato)

            //para contrato especifico mezclado con lens
            $table->string('titulo_contrato');
            $table->longText('descripcion_contrato');
            $table->timestamp('fecha_inicio_contrato');
            $table->timestamp('fecha_vencimiento_contrato');
            $table->string('monto_contrato');
            $table->integer('fecha_inicial_pago_contrato');//Intervalo de pago 1 a 10 de cada mes
            $table->integer('fecha_final_pago_contrato');//Intervalo de pago 1 a 10 de cada mes
            $table->double('porcentaje_aumento_contrato');
            $table->integer('periodo_aumento_contrato');//cada 6 meses aumenta en el porcentaje establecido
            $table->integer('retraso_maximo_pago_contrato');//periodo de tiempo en el que se puede retrasar el pago antes de que se desaloje
            //dias

            $table->softDeletes();
            $table->timestamps();
        });

        //crear tabla forma de pago
        Schema::create('forma_pago', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_forma_pago');
            $table->softDeletes();
            $table->timestamps();
        });

        //crear tabla contrato_forma_pago
        Schema::create('contrato_forma_pago', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_contrato')->constrained('contrato');
            $table->foreignId('id_forma_pago')->constrained('forma_pago');
            $table->softDeletes();
            $table->timestamps();
        });

        //una publicacion puede tener muchos contratos
        Schema::table('contrato', function (Blueprint $table) {
            $table->foreignId('id_publicacion')->constrained('publicacion');
        });

        //un usuario puede tener muchos contratos
        Schema::table('contrato', function (Blueprint $table) {
            $table->foreignId('id_usuario')->constrained('users');
        });

        Schema::table('mercado-pago-transacciones', function (Blueprint $table) {
            $table->foreignId('id_contrato')->constrained('contrato');
        });

        //un contrato puede tener muchas formas de pago


//        //un contrato tiene muchos mercado_pago_trasnacciones
//        Schema::table('contrato', function (Blueprint $table) {
//            $table->foreignId('id_mercado_pago_transaccion')->constrained('mercado_pago_transaccion');

//        //un cntrato pertenece a una publicacion
//        Schema::table('contrato', function (Blueprint $table) {
//            $table->foreignId('id_publicacion')->constrained('publicacion');
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contrato');
    }
};
