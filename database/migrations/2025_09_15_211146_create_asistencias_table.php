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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('confirmando_id')->constrained()->cascadeOnDelete();
            $table->foreignId('jornada_id')->constrained()->cascadeOnDelete();
            $table->enum('estado', ['asistio', 'tardanza', 'falta_justificada', 'falta_sin_justificar']);
            $table->timestamps();
            $table->unique(['confirmando_id', 'jornada_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
