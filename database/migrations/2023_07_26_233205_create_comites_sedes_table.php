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
            $table->unsignedBigInteger("comi_pro");
            $table->foreign("comi_pro")->references("idPrograma")->on("sede_programas")->onDelete('cascade');
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
