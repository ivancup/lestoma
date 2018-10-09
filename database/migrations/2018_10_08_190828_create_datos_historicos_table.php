<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosHistoricosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_historicos', function (Blueprint $table) {
            $table->increments('id');
            $table->double('temperatura_ambiente')->nullable();
            $table->double('temperatura_agua')->nullable();
            $table->double('ph')->nullable();
            $table->double('humedad')->nullable();
            $table->unsignedInteger('fk_sede');
            $table->timestamps();

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
        Schema::dropIfExists('datos_historicos');
    }
}
