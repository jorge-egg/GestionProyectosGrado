<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasePropuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_propuestas', function (Blueprint $table) {
            $table->bigIncrements("idPropuesta");
            $table->text("titulo");
            $table->text("linea_invs");
            $table->text("desc_problema");
            $table->text("obj_general");
            $table->text("obj_especificos");    
            $table->string("estado");
            $table->string("fecha_cierre");
            $table->unsignedBigInteger("fech_sede");
            $table->timestamps();
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
        Schema::dropIfExists('fase_propuestas');
    }
}
