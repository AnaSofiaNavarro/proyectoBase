<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeccionUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('seccion_usuario', function (Blueprint $table) {
    $table->engine = 'InnoDB';

    $table->id('idSeccionUsuario'); // equivale a unsignedBigInteger + autoIncrement

    $table->unsignedBigInteger('fkusuario');
    $table->foreign('fkusuario')->references('id')->on('users')->onDelete('cascade');

    $table->integer('fkseccion'); // Asegúrate que `idseccion` también sea unsigned
    $table->foreign('fkseccion')->references('idseccion')->on('secciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('seccion_usuario');
    }
}