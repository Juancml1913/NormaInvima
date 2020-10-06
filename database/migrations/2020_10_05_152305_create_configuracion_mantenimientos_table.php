<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion_mantenimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_instalacion');
            $table->foreign('id_instalacion')->references('id')->on('instalaciones_fisicas');
            $table->unsignedBigInteger('periodo_dias');
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
        Schema::dropIfExists('configuracion_mantenimientos');
    }
}
