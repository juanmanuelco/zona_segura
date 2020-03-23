<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');


            $table->enum('tipo', ['Administrador', 'Usuario'])->default('Usuario');
            $table->string('existente')->default(true);
            $table->string('token')->nullable();
            $table->double('longitud', 18, 12)->default(0);
            $table->double('latitud', 18, 12)->default(0);
            $table->enum('estado', ['0', '1', '2', '3', '4'])->default('0');

            $table->string('cedula')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();

            $table->date('nacimiento')->nullable();        
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro'])->default('Otro');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
