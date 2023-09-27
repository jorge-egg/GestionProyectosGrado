<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_users', function (Blueprint $table) {
            $table->id('numeroDocumento');
            $table->string("nombre");
            $table->string("apellido");
            $table->string("email");
            $table->string("numeroCelular");  
            $table->unsignedBigInteger("usua_sede");
            $table->unsignedBigInteger("usua_users");
            $table->foreign("usua_sede")->references("idSede")->on("sedes");
            $table->foreign("usua_users")->references("idUsers")->on("users");       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
