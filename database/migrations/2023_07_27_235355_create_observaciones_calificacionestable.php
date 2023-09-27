<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacionesCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observaciones_calificaciones', function (Blueprint $table) {
            $table->bigIncrements("idObservacion"); 
            $table->string("titulo");
            $table->string("linea_invs");
            $table->string("desc_problema");
            $table->string("obj_general");
            $table->string("obj_especificos");  
            $table->unsignedBigInteger("obse_cal");         
            $table->timestamps();
            $table->foreign("obse_cal")->references("idCalificacion")->on("calificaciones");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observaciones');
    }
}
