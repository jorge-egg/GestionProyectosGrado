<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalifSubitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calif_subitems', function (Blueprint $table) {
            $table->bigIncrements('idCalifSubitem');
            $table->unsignedBigInteger('ValorCalifSubitem');
            $table->unsignedBigInteger('subitem');
            $table->unsignedBigInteger("calificacion")->nullable();
            $table->foreign("calificacion")->references("idCalificacion")->on("calificaciones")->onDelete('cascade');
            $table->foreign("subitem")->references("idSubitem")->on("sub_items")->onDelete('cascade');
            $table->foreign("ValorCalifSubitem")->references("idValorCalifSubitem")->on("valorcalif_subitems")->onDelete('cascade');
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
        Schema::dropIfExists('calif_subitems');
    }
}
