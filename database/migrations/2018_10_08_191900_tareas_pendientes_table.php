<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TareasPendientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas_pendientes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fk_protocolo');
            $table->unsignedInteger('fk_user');
            $table->timestamps();

            $table->foreign('fk_protocolo')->references('id')->on('protocolos')->onDelete('cascade');
            $table->foreign('fk_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas_pendientes');
    }
}
