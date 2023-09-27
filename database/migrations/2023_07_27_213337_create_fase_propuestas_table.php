<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasePropuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_propuestas', function (Blueprint $table) {
            $table->bigIncrements("idPropuesta");
            $table->string("titulo");
            $table->string("linea_invs");
            $table->string("desc_problema");
            $table->string("obj_general");
            $table->string("obj_especificos");
            $table->string("frecha_subida");
            $table->string("frecha_actu");
            $table->string("calificacion");
            $table->string("estado");
            $table->string("fecha_cierre");
            $table->unsignedBigInteger("prop_fase");
            $table->timestamps();
            $table->foreign("prop_fase")->references("idFase")->on("proyecto_fases");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propuestas');
    }
}
