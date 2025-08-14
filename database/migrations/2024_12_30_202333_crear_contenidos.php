<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearContenidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenidos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('idcontenido')->autoIncrement()->nullable(false);
            $table->date('fecha')->nullable();
            $table->string('encabezado', 250);
            $table->string('encabezadoen', 250)->nullable();
            $table->string('slug', 250)->unique();
            $table->string('subtitulo', 250)->nullable();
            $table->string('subtituloen', 250)->nullable();
            $table->text('descripcion')->nullable();
            $table->text('descripcionen')->nullable();
            $table->string('fuente', 250)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->integer('extension')->nullable();
            $table->string('correo', 200)->nullable();
            $table->integer('fktipocontenido')->nullable();
            $table->foreign('fktipocontenido')->references('idtipocontenido')->on('tipocontenidos');
            $table->string('archivo', 250)->nullable();
            $table->string('url', 250)->nullable();
            $table->boolean('target');
            $table->boolean('relevante');
            $table->boolean('activo');
            $table->integer('orden');
            $table->integer('fkusuario');
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
        Schema::dropIfExists('contenidos');
    }
}