<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('valor');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('id_estado')->nullable();
            $table->foreign('id_estado')->references('id')->on("estados")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_id_estado_foreign');
            $table->dropColumn('id_estado');
        });
        Schema::dropIfExists('estados');
    }
}
