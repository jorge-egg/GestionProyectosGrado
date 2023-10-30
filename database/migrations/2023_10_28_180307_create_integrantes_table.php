<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrantes', function (Blueprint $table) {
            $table->id('idIntegrantes');
            $table->unsignedBigInteger('usuario');
            $table->unsignedBigInteger('proyecto');
            $table->foreign("usuario")->references("numeroDocumento")->on("usuarios_users")->onDelete('cascade');
            $table->foreign('proyecto')->references('idProyecto')->on('sede_proyectos_grado')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('integrantes');
    }
}
