<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasesCronogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fases_cronogramas', function (Blueprint $table) {
            $table->id('idFase');
            $table->string('fase');
            $table->unsignedBigInteger("fase_fech");
            $table->foreign('fase_fech')->references('idFecha')->on("fechas_grupos")->onDelete('cascade');
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
        Schema::dropIfExists('fases_cronogramas');
    }
}
