<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSustentacionsFasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sustentacions_fases', function (Blueprint $table) {
            $table->bigIncrements("idSustentacion");
            $table->unsignedBigInteger("Sust_fase");
            
            $table->foreign("Sust_fase")->references("idFase")->on("fases_proyectos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sustentacions');
    }
}
