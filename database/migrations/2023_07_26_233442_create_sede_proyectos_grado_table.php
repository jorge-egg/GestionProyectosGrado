<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSedeProyectosGradoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sede_proyectos_grado', function (Blueprint $table) {
            $table->bigIncrements("idProyecto");
            $table->boolean("estado");
            $table->string("codigoproyecto");
            $table->unsignedBigInteger("proy_sede");
            $table->unsignedBigInteger("proy_bibl");
            $table->foreign("proy_sede")->references("idSede")->on("sedes")->onDelete('cascade');
            $table->foreign("proy_bibl")->references("idBiblioteca")->on("sede_bibliotecas")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sede_proyectos_grado');
    }
}
