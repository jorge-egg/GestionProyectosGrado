<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCronogramaFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechas_grupos', function (Blueprint $table) {
            $table->bigIncrements("idFecha");
            $table->string("fecha");
            $table->unsignedBigInteger("fech_grup");
            $table->timestamps();
            $table->foreign("fech_grup")->references("idGrupo")->on("cronograma_grupos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fechas');
    }
}
