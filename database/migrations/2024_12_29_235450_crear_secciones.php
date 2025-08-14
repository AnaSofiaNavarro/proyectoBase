<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearSecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('idseccion')->autoIncrement()->nullable(false);
            $table->integer('fkapartado');
            $table->foreign('fkapartado')->references('idapartado')->on('apartados');            
            $table->string('seccion', 250);
            $table->string('seccionen', 250)->nullable();
            $table->string('slug', 250)->unique();
            $table->string('descripcion', 250)->nullable();
            $table->string('descripcionen', 250)->nullable();
            $table->string('division', 250)->nullable();
            $table->boolean('enlace');
            $table->string('url', 250)->nullable();
            $table->boolean('target');
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
        Schema::dropIfExists('secciones');
    }
}