<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnteproyectosFasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anteproyectos_fases', function (Blueprint $table) {
            $table->bigIncrements("idAnteproyecto");
            $table->unsignedBigInteger("ante_fase");
            
            $table->foreign("ante_fase")->references("idFase")->on("fases_proyectos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anteproyectos');
    }
}
