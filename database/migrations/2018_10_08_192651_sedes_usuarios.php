<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SedesUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sedes_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fk_usuario');
            $table->unsignedInteger('fk_sede');

            $table->foreign('fk_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fk_sede')->references('id')->on('sedes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sedes_usuarios');
    }
}
