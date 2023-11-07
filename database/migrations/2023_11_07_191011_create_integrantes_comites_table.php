<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegrantesComitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrantes_comites', function (Blueprint $table) {
            $table->id('idIntegrantesComite');
            $table->unsignedBigInteger('comite_usuario');
            $table->unsignedBigInteger('inte_comi');
            $table->timestamps();
            $table->foreign("comite_usuario")->references("numeroDocumento")->on("usuarios_users")->onDelete('cascade');
            $table->foreign('inte_comi')->references('idComite')->on('comites_sedes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('integrantes_comites');
    }
}
