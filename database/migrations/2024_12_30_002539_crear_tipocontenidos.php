<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTipocontenidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipocontenidos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('idtipocontenido')->autoIncrement()->nullable(false);
            $table->string('tipocontenido', 100);
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
        Schema::dropIfExists('tipocontenidos');
    }
}