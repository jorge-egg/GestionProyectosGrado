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
            $table->string("cal_investigacion");
            $table->string("cal_Descproblema");
            $table->string("cal_titulo");
            $table->string("cal_objgeneral");
            $table->string("cal_objespecificos");
            $table->unsignedBigInteger("cal_pro");
            $table->unsignedBigInteger("cal_ante");
            $table->unsignedBigInteger("cal_prof");
            $table->unsignedBigInteger("cal_sust");
            $table->timestamps();
            $table->foreign("cal_pro")->references("idPropuesta")->on("fase_propuestas");
            $table->foreign("cal_ante")->references("idAnteproyecto")->on("fase_anteproyectos");
            $table->foreign("cal_prof")->references("idProyectofinal")->on("fase_proyectosfinales");
            $table->foreign("cal_sust")->references("idSustentacion")->on("fase_sustentaciones");

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
