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
        Schema::create('amparos', function (Blueprint $table) {
            $table->id();

            $table->integer('numero');
            $table->integer('anio');
            $table->foreignId('juzgado_id');
            $table->date('fecha');
            $table->string('actoreclamado', 250);
            $table->date('fechaacuerdo');
            $table->longText('nombrequejoso');
            $table->longText('nombretercero');
            $table->text('sintesis');
            $table->string('toca', 60);
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amparos');
    }
};
