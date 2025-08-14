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
        Schema::create('jurisprudencias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('epoca', 25);
            $table->text('descripcion');
            $table->text('textocompleto');
            $table->text('url');
            $table->string('otrasmaterias', 60)->nullable();
            $table->foreignId('tipojurisprudencia_id')->constrained();
            $table->foreignId('materia_id')->constrained();
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurisprudencias');
    }
};
