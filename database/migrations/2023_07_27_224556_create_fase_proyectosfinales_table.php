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

            $table->string("documento", 20);
            $table->string("aprobacionDocen", 2);
            $table->text("observaDocent")->nullable();
            $table->string("juradoUno", 12);
            $table->string("juradoDos", 12);
            $table->string('estado', 100);
            $table->time('fecha_aplazado')->nullable();

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
