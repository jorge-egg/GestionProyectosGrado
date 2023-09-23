<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSustentacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sustentacions', function (Blueprint $table) {
            $table->bigIncrements("idSustentacion");
            $table->unsignedBigInteger("Sust_fase");
            
            $table->foreign("Sust_fase")->references("idFase")->on("fases");
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
