<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCronogramaFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechas_grupos', function (Blueprint $table) {
            $table->bigIncrements("idFecha");
            $table->date("fecha_apertura");
            $table->date("fecha_cierre");
            $table->unsignedBigInteger("fech_grup");
            $table->unsignedBigInteger("fech_fase");
            $table->foreign("fech_grup")->references("idGrupo")->on("cronograma_grupos")->onDelete('cascade');
            $table->foreign('fech_fase')->references('idFase')->on("fases_cronogramas")->onDelete('cascade');
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
        Schema::dropIfExists('fechas_grupos');
    }
}
