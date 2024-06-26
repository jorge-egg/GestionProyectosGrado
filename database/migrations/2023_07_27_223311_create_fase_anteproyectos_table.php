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
            $table->string("documento", 20);
            $table->string("cartaDirector", 20);
            $table->string("aprobacionDocen", 2);
            $table->text("observaDocent")->nullable();
            $table->string("juradoUno", 12);
            $table->string("juradoDos", 12);
            $table->string("estadoJUno", 100);
            $table->string("estadoJDos", 100);
            $table->string('estado', 100);
            $table->date('fecha_aplazado')->nullable();
            $table->unsignedBigInteger("ante_proy");

            $table->foreign('ante_proy')->references('idProyecto')->on("sede_proyectos_grado")->onDelete('cascade');
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
        Schema::dropIfExists('fase_anteproyectos');
    }
}
