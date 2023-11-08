<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaseSustentacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_sustentaciones', function (Blueprint $table) {
            $table->bigIncrements("idSustentacion");
            $table->unsignedBigInteger("sust_proy");
            $table->foreign('sust_proy')->references('idProyecto')->on("sede_proyectos_grado")->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fase_sustentaciones');
    }
}
