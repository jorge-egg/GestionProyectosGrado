<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePonderadosCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ponderados_calificaciones', function (Blueprint $table) {
            $table->bigIncrements("idPonderado");
            $table->string("ponderado_item");
            $table->unsignedBigInteger("pond_cal");            
            
            $table->foreign("pond_cal")->references("idCalificacion")->on("calificaciones")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ponderados_calificaciones');
    }
}
