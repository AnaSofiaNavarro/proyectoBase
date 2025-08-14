<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearContenidoanexos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenidoanexos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('idanexo')->autoIncrement()->nullable(false);
            $table->date('fecha')->nullable();
            $table->integer('fkcontenido')->nullable();
            $table->foreign('fkcontenido')->references('idcontenido')->on('contenidos');
            $table->integer('fktipo')->nullable();
            $table->foreign('fktipo')->references('idtipo')->on('tipos');
            $table->string('imagen', 200)->nullable();
            $table->string('video', 200)->nullable();
            $table->string('archivo', 200)->nullable();
            $table->string('descripcion', 250)->nullable();
            $table->string('url', 250)->nullable();
            $table->integer('orden');
            $table->boolean('activo');
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
        Schema::dropIfExists('contenidoanexos');
    }
}