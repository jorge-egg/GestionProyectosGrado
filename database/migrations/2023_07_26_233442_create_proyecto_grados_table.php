<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoGradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_grados', function (Blueprint $table) {
            $table->bigIncrements("idProyecto");
            $table->string("estado");
            $table->string("codigoproyecto"); 
            $table->unsignedBigInteger("proy_sede");
            $table->unsignedBigInteger("proy_bibl");

            $table->foreign("proy_sede")->references("idSede")->on("sedes");
            $table->foreign("proy_bibl")->references("idBiblioteca")->on("bibliotecas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto_grados');
    }
}
