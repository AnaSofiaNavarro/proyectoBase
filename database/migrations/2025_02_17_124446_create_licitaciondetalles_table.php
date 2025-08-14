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
        Schema::create('licitaciondetalles', function (Blueprint $table) {
            $table->id();
            $table->string('archivo', 120);
            $table->foreignId('licitacione_id');
            $table->foreignId('tipocatalogo_id');
            $table->tinyInteger('publicar')->defaultValue(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licitaciondetalles');
    }
};
