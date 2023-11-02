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
            $table->unsignedBigInteger("fech_sede");
            $table->timestamps();
            $table->foreign("fech_grup")->references("idGrupo")->on("cronograma_grupos")->onDelete('cascade');
            $table->foreign('fech_sede')->references('idSede')->on("sedes")->onDelete('cascade');
            
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
