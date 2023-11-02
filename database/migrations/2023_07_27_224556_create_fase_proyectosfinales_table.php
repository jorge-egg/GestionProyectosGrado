<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaseProyectosfinalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_proyectosfinales', function (Blueprint $table) {
            $table->bigIncrements("idProyectofinal");
            $table->unsignedBigInteger("pfin_proy");

            $table->foreign('pfin_proy')->references('idProyecto')->on("sede_proyectos_grado")->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fase_proyectosfinales');
    }
}
