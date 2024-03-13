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
            $table->unsignedBigInteger('usuario');
            $table->unsignedBigInteger('comite');
            $table->timestamps();
            $table->foreign("usuario")->references("numeroDocumento")->on("usuarios_users")->onDelete('cascade');
            $table->foreign('comite')->references('idComite')->on('comites_sedes')->onDelete('cascade');
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
