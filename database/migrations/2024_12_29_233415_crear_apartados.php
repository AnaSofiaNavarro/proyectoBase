<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearApartados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartados', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('idapartado')->autoIncrement()->nullable(false);
            $table->string('apartado', 50);
            $table->string('apartadoen', 200)->nullable();
            $table->string('slug', 50)->unique();
            $table->boolean('enlace');
            $table->string('url', 250)->nullable();
            $table->boolean('target');
            $table->boolean('menu');
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
        Schema::dropIfExists('apartados');
    }
}