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
            $table->string('integrante1');
            $table->string('integrante2',null);
            $table->string('integrante3',null);
            $table->unsignedBigInteger('int_usua');
            $table->unsignedBigInteger('int_proy');
            $table->foreign("int_usua")->references("numeroDocumento")->on("usuarios_users")->onDelete('cascade');
            $table->foreign('int_proy')->references('idProyecto')->on('sede_proyectos_grado')->onDelete('cascade');
            $table->timestamps();
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
