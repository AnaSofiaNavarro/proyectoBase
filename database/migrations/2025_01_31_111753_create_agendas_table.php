<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->integer('numexpediente');
            $table->integer('anioexpediente');
            $table->string('tipoaudiencia', 80);
            $table->string('sala', 45);
            $table->string('delitojuicio', 250);
            $table->string('juzgador', 250);
            $table->text('imputados');
            $table->text('victimas');
            $table->foreignId('juzgado_id');
            $table->foreignId('etapa_id');
            $table->foreignId('tipodocumento_id');
            $table->foreignId('visible')->default(0);
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
