<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePonderadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ponderados', function (Blueprint $table) {
            $table->bigIncrements("idPonderado");
            $table->string("ponderado_item");
            $table->unsignedBigInteger("pond_cal");            
            
            $table->foreign("pond_cal")->references("idCalificacion")->on("calificaciones");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ponderados');
    }
}
