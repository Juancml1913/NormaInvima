<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicadores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('objetivo');
            $table->string('alcance');
            $table->double('numerador');
            $table->double('denominador');
            $table->double('complemento');
            $table->string('responsables');
            $table->string('unidad_medida');
            $table->string('meta');
            $table->string('sentido');
            $table->string('frecuencia');
            $table->tinyInteger('tabla');
            $table->tinyInteger('barras');
            $table->tinyInteger('torta');
            $table->tinyInteger('lineal');
            $table->tinyInteger('modulo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicadors');
    }
}
