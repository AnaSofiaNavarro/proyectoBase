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
        Schema::create('licitaciones', function (Blueprint $table) {
            $table->id();
            $table->date('fechapublicacion');
            $table->string('descripcion', 300);
            $table->longText('objetivo');
            $table->tinyInteger('archivo')->default(1);
            $table->foreignId('tipolicitacione_id');
            $table->integer('idlicitacion');
            $table->integer('cve_tribunal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licitaciones');
    }
};
