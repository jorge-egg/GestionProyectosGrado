<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasesProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fases_proyectos', function (Blueprint $table) {
            $table->bigIncrements("idFase");
            $table->string("estado");
            $table->unsignedBigInteger("fase_proy");
            $table->unsignedBigInteger("fase_cron");
            
            $table->foreign("fase_proy")->references("idProyecto")->on("proyecto_grados_sedes");
            $table->foreign("fase_cron")->references("idCronograma")->on("cronogramas");

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fases');
    }
}
