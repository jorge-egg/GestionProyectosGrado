<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoFasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_fases', function (Blueprint $table) {
            $table->bigIncrements("idFase");
            $table->string("estado");
            $table->unsignedBigInteger("fase_proy");
            $table->unsignedBigInteger("fase_cron");

            $table->foreign("fase_proy")->references("idProyecto")->on("sede_proyectos_grado");
            $table->foreign("fase_cron")->references("idCronograma")->on("proyecto_cronogramas");

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
