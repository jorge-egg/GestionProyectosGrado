<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCronogramaGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronograma_grupos', function (Blueprint $table) {
            $table->bigIncrements("idGrupo");
            $table->string("numerogrupo");
            $table->string("estado");
            $table->unsignedBigInteger("grup_cron");

            $table->foreign("grup_cron")->references("idCronograma")->on("proyecto_cronogramas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}
