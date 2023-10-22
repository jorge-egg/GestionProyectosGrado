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
            $table->string("fecha_apertura");
            $table->string("fecha_cierre");
            $table->unsignedBigInteger("fech_grup");
            $table->unsignedBigInteger("fech_cron");
            $table->timestamps();
            $table->foreign("fech_cron")->references("idCronograma")->on("proyecto_cronogramas")->onDelete('cascade');
            $table->foreign("fech_grup")->references("idGrupo")->on("cronograma_grupos")->onDelete('cascade');
            
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
