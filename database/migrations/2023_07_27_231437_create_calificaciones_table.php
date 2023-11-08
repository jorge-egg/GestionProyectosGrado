<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->bigIncrements("idCalificacion");
            $table->double("calificacion");
            $table->unsignedBigInteger("cal_pro");
            $table->unsignedBigInteger("cal_ante");
            $table->unsignedBigInteger("cal_prof");
            $table->unsignedBigInteger("cal_sust");
            $table->timestamps();
            $table->foreign("cal_pro")->references("idPropuesta")->on("fase_propuestas")->onDelete('cascade');
            $table->foreign("cal_ante")->references("idAnteproyecto")->on("fase_anteproyectos")->onDelete('cascade');
            $table->foreign("cal_prof")->references("idProyectofinal")->on("fase_proyectosfinales")->onDelete('cascade');
            $table->foreign("cal_sust")->references("idSustentacion")->on("fase_sustentaciones")->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificaciones');
    }
}
