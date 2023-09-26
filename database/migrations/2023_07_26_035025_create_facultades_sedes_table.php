<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultadesSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facultades_sedes', function (Blueprint $table) {
            $table->bigIncrements("idFacultad");
            $table->string("ingenieria");
            $table->string("economia");
            $table->string("artes");
            $table->unsignedBigInteger("facu_sede");
            $table->foreign("facu_sede")->references("idSede")->on("sedes");     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facultades');
    }
}
