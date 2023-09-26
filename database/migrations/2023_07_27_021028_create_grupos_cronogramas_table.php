<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposCronogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_cronogramas', function (Blueprint $table) {
            $table->bigIncrements("idGrupo");
            $table->string("numerogrupo");
            $table->string("estado");
            $table->unsignedBigInteger("grup_cron");
            
            $table->foreign("grup_cron")->references("idCronograma")->on("cronogramas");
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
