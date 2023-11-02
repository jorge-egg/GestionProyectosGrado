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
            $table->unsignedBigInteger("fech_sede");

            $table->foreign('fech_sede')->references('idSede')->on("sedes")->onDelete('cascade');
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
