<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_programas', function (Blueprint $table) {
            $table->id('idUsuario_programa');
            $table->unsignedBigInteger('usuario');
            $table->unsignedBigInteger('programa');
            $table->foreign("usuario")->references("numeroDocumento")->on("usuarios_users")->onDelete('cascade');
            $table->foreign('programa')->references('idPrograma')->on('sede_programas')->onDelete('cascade');
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
        Schema::dropIfExists('usuario_programas');
    }
}
