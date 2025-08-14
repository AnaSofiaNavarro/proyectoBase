<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearVistas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('idvista')->autoIncrement()->nullable(false);
            
            $table->integer('fkapartado')->nullable();
            $table->foreign('fkapartado')->references('idapartado')->on('apartados');

            $table->integer('fkseccion')->nullable();
            $table->foreign('fkseccion')->references('idseccion')->on('secciones');
            
            $table->integer('fkcontenido')->nullable();
            $table->foreign('fkcontenido')->references('idcontenido')->on('contenidos');

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
        Schema::dropIfExists('vistas');
    }
}