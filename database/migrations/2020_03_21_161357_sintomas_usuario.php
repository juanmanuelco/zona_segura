<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SintomasUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sintomas_usuario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario');
            $table->unsignedBigInteger('sintoma');

            $table->dateTimeTz('fecha_registro')->nullable();

            $table->boolean('avaluado')->default(false);

            $table->foreign('usuario')->references('id')->on('users');
            $table->foreign('sintoma')->references('id')->on('sintomas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sintomas_usuario');
    }
}
