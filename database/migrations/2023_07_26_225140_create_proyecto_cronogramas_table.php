<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoCronogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_cronogramas', function (Blueprint $table) {
            $table->bigIncrements("idCronograma");
            $table->unsignedBigInteger("cron_sede");
            $table->foreign('cron_sede')->references('idSede')->on("sedes")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto_cronogramas');
    }
}
