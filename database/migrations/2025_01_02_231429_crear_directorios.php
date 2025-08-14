<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearDirectorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directorios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('iddirectorio')->autoIncrement()->nullable(false);
            $table->integer('fkmunicipio')->nullable();
            $table->foreign('fkmunicipio')->references('idmunicipio')->on('municipios');
            $table->integer('fkpadre')->nullable();
            $table->string('area', 250)->nullable();
            $table->string('nombre', 250)->nullable();
            $table->string('paterno', 250)->nullable();
            $table->string('materno', 250)->nullable();
            $table->string('direccion', 250)->nullable();
            $table->string('telefono', 250)->nullable();
            $table->string('fax', 250)->nullable();
            $table->string('correo', 250)->nullable();
            $table->string('latitud', 30)->nullable();
            $table->string('longitud', 30)->nullable();
            $table->integer('orden');
            $table->boolean('titular');
            $table->boolean('mando');
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
        Schema::dropIfExists('directorios');
    }
}