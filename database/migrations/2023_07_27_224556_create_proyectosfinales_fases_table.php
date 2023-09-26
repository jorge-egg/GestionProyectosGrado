<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosfinalesFasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectosfinales_fases', function (Blueprint $table) {
            $table->bigIncrements("idProyectofinal");
            $table->unsignedBigInteger("prof_fase");
            
            $table->foreign("prof_fase")->references("idFase")->on("fases_proyectos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectosfinales');
    }
}
