<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsCalificacioesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_calificacioes', function (Blueprint $table) {
            $table->id('idItem');
            $table->string('items');
            $table->unsignedBigInteger("item_cali");
            $table->foreign("item_cali")->references("idCalificacion")->on("calificaciones")->onDelete('cascade');
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
        Schema::dropIfExists('items_calificacioes');
    }
}
