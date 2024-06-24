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
            $table->unsignedBigInteger("usua_estado");
            $table->foreign("usua_sede")->references("idSede")->on("sedes")->onDelete('cascade');
            $table->foreign("usua_users")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("usua_estado")->references("id")->on("users")->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('usuarios_users');
    }
}
