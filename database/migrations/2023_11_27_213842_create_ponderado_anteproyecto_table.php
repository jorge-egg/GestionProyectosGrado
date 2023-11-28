<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePonderadoAnteproyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ponderado_anteproyecto', function (Blueprint $table) {
            $table->bigIncrements("idPonderado_antep");
            $table->double("ponderado");
            $table->unsignedBigInteger("item_pond");
            $table->foreign("item_pond")->references("idItem")->on("items")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ponderado_anteproyecto');
    }
}
