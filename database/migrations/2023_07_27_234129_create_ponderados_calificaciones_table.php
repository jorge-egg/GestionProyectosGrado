<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePonderadosCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ponderados_calificaciones', function (Blueprint $table) {
            $table->bigIncrements("idPonderado");
            $table->string("ponderado");
            $table->unsignedBigInteger("item_pond");
            $table->unsignedBigInteger("propuesta")->nullable();
            $table->unsignedBigInteger("anteproyecto")->nullable();
            $table->unsignedBigInteger("proyecto_final")->nullable();
            $table->unsignedBigInteger("sustentacion")->nullable();
            $table->foreign("item_pond")->references("idItem")->on("items")->onDelete('cascade');
            $table->foreign("propuesta")->references("idPropuesta")->on("fase_propuestas")->onDelete('cascade');
            $table->foreign("anteproyecto")->references("idAnteproyecto")->on("fase_anteproyectos")->onDelete('cascade');
            $table->foreign("proyecto_final")->references("idProyectofinal")->on("fase_proyectosfinales")->onDelete('cascade');
            $table->foreign("sustentacion")->references("idSustentacion")->on("fase_sustentaciones")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ponderados_calificaciones');
    }
}
