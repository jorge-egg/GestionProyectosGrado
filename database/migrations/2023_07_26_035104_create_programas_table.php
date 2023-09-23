<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->bigIncrements("idPrograma");
            $table->string("programa");
            $table->unsignedBigInteger("prog_facu");
            $table->unsignedBigInteger("prog_sede");
            $table->unsignedBigInteger("prog_usua");
            $table->foreign("prog_facu")->references("idFacultad")->on("facultades");
            $table->foreign("prog_sede")->references("idSede")->on("sedes");  
            $table->foreign("prog_usua")->references("numeroDocumento")->on("usuarios"); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programas');
    }
}
