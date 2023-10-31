<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComitesSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comites_sedes', function (Blueprint $table) {
            $table->bigIncrements("idComite");
            $table->string("nombre");
            $table->unsignedBigInteger("comi_sede");
            $table->foreign("comi_sede")->references("idSede")->on("sedes")->onDelete('cascade');
            $table->softDeletes();   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comites_sedes');
    }
}
