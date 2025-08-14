<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();

            // Obligatorios
            $table->boolean('trabajaPJE');
            $table->boolean('conoceNombre');
            $table->string('quejaConducta');
            $table->date('fechaHecho');
            $table->time('horaHecho');
            $table->string('lugarHecho');
            $table->string('frecuenciaHechos');
            $table->text('descripcionHechos');
            $table->text('accionPosterior');
            $table->text('cambioActitud');
            $table->text('cambioLaboral');
            $table->text('afectacionPersonal');
            $table->boolean('hayTestigos');
            $table->boolean('proporcionaDatos');
            $table->boolean('apoyoPsicologico');

            // Opcionales
            $table->string('nombreDenunciado')->nullable();
            $table->string('apellidoDenunciado')->nullable();
            $table->string('puestoDenunciado')->nullable();
            $table->string('jefeDenunciado')->nullable();

            $table->json('evidencias')->nullable();

            $table->string('nombreTestigo1')->nullable();
            $table->string('apellidoTestigo1')->nullable();
            $table->string('nombreTestigo2')->nullable();
            $table->string('apellidoTestigo2')->nullable();

            $table->string('nombreContacto')->nullable();
            $table->string('apellidoContacto')->nullable();
            $table->string('celularContacto')->nullable();
            $table->string('correoContacto')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncias');
    }
};