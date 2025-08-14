<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearMunicipios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('idmunicipio')->autoIncrement()->nullable(false);
            $table->integer('fkestado');
            $table->foreign('fkestado')->references('idestado')->on('estados');
            $table->string('clave', 5);
            $table->string('municipio', 250);
            $table->string('latitud', 30)->nullable();
            $table->string('longitud', 30)->nullable();
            $table->longText('poligono')->nullable();
            $table->integer('zoom')->nullable();
            $table->string('latitudpol', 30)->nullable();
            $table->string('longitudpol', 30)->nullable();
            $table->string('color', 20)->nullable();
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
        Schema::dropIfExists('municipios');
    }
}