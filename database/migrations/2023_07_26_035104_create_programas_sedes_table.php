<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramasSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas_sedes', function (Blueprint $table) {
            $table->bigIncrements("idPrograma");
            $table->string("programa");
            $table->unsignedBigInteger("prog_facu");
            $table->unsignedBigInteger("prog_sede");
            $table->unsignedBigInteger("prog_usua");
            $table->foreign("prog_facu")->references("idFacultad")->on("facultades_sedes");
            $table->foreign("prog_sede")->references("idSede")->on("sedes");  
            $table->foreign("prog_usua")->references("numeroDocumento")->on("usuarios_users"); 
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
