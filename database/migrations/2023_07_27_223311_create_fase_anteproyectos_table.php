<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaseAnteproyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_anteproyectos', function (Blueprint $table) {
            $table->bigIncrements("idAnteproyecto");
            $table->unsignedBigInteger("ante_proy");

            $table->foreign('ante_proy')->references('idProyecto')->on("sede_proyectos_grado")->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fase_anteproyectos');
    }
}
