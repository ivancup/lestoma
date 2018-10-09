<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TareasHistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas_historial', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_tarea');
            $table->string('protocolo');
            $table->unsignedInteger('fk_users');
            $table->timestamps();

            $table->foreign('fk_users')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas_historial');
    }
}
