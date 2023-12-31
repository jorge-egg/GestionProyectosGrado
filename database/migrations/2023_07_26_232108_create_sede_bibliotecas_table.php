<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSedeBibliotecasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sede_bibliotecas', function (Blueprint $table) {
            $table->bigIncrements("idBiblioteca");
            $table->unsignedBigInteger("bibl_sede");
            $table->foreign("bibl_sede")->references("idSede")->on("sedes")->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sede_bibliotecas');
    }
}
