<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacionesCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observaciones_calificaciones', function (Blueprint $table) {
            $table->bigIncrements("idObservacion");
            $table->string("observacion");
            $table->unsignedBigInteger("obs_item");
            $table->foreign("obs_item")->references("idItem")->on("items")->onDelete('cascade');
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
        Schema::dropIfExists('observaciones_calificaciones');
    }
}
