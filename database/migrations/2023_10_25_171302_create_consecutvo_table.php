<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsecutvoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consecutvo', function (Blueprint $table) {
            $table->id('IdConsecutivo');
            $table->string('consecutivo');
            $table->string('año');
            $table->unsignedBigInteger("conc_proy");
            $table->foreign("conc_proy")->references("idProyecto")->on("sede_proyectos_grado")->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consecutvo');
    }
}
