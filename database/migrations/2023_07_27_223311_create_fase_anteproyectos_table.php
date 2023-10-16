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
            $table->unsignedBigInteger("ante_fase");

            $table->foreign("ante_fase")->references("idFase")->on("proyecto_fases")->onDelete('cascade');
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
