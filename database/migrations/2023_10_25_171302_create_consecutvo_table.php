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
            $table->date('año');
            $table->unsignedBigInteger("conc_sede");
            $table->foreign("conc_sede")->references("idSede")->on("sedes")->onDelete('cascade');
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
