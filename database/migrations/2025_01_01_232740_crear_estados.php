<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEstados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('idestado')->autoIncrement()->nullable(false);
            $table->integer('fkpais');
            $table->foreign('fkpais')->references('idpais')->on('paises');
            $table->string('estado', 200);
            $table->longText('poligono')->nullable();
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
        Schema::dropIfExists('estados');
    }
}