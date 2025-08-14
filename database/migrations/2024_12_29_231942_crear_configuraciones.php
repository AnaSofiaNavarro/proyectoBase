<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearConfiguraciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('idconfiguracion')->autoIncrement()->nullable(false);
            $table->string('imagen', 200)->nullable();
            $table->string('imagenc', 200)->nullable();
            $table->string('nombre', 200)->nullable();
            $table->string('descripcion', 500)->nullable();
            $table->string('descripcionen', 500)->nullable();
            $table->string('telefonoprincipal', 100)->nullable();
            $table->string('telefonosecundario', 100)->nullable();
            $table->string('correoprincipal', 200)->nullable();
            $table->string('correosecundario', 200)->nullable();
            $table->string('buzon', 200)->nullable();
            $table->string('prefijo', 5)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('facebook', 200)->nullable();
            $table->string('instagram', 200)->nullable();
            $table->string('twitter', 200)->nullable();
            $table->string('youtube', 200)->nullable();
            $table->string('tiktok', 200)->nullable();
            $table->string('pagina', 200)->nullable();
            $table->string('latitud', 20)->nullable();
            $table->string('longitud', 20)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->string('rfc', 13)->nullable();
            $table->string('razon', 255)->nullable();
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
        Schema::dropIfExists('configuraciones');
    }
}