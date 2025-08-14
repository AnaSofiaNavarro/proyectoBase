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
        Schema::create('edictos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('numero');
            $table->string('descripcion', 600);
            $table->string('archivo', 45);
            $table->foreignId('materia_id')->constrained();
            $table->foreignId('juzgado_id')->constrained();
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edictos');
    }
};
