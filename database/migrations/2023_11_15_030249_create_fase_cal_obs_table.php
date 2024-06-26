<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaseCalObsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_cal_obs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("calificacion_fase");
            $table->unsignedBigInteger("propuesta")->nullable();
            $table->unsignedBigInteger("anteproyecto")->nullable();
            $table->unsignedBigInteger("proyecto_final")->nullable();
            $table->unsignedBigInteger("sustentacion")->nullable();
            
            $table->string("numeroJurado", 2);
            $table->foreign("calificacion_fase")->references("idCalificacion")->on("calificaciones")->onDelete('cascade');
            $table->foreign("propuesta")->references("idPropuesta")->on("fase_propuestas")->onDelete('cascade');
            $table->foreign("anteproyecto")->references("idAnteproyecto")->on("fase_anteproyectos")->onDelete('cascade');
            $table->foreign("proyecto_final")->references("idProyectofinal")->on("fase_proyectosfinales")->onDelete('cascade');
            $table->foreign("sustentacion")->references("idSustentacion")->on("fase_sustentaciones")->onDelete('cascade');

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
        Schema::dropIfExists('fase_cal_obs');
    }
}
