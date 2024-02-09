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
            $table->time("fecha_cierre")->nullable();
            $table->time('fecha_aplazado')->nullable();
            $table->unsignedBigInteger("prop_proy");
            $table->timestamps();
            $table->foreign('prop_proy')->references('idProyecto')->on("sede_proyectos_grado")->onDelete('cascade');

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
