<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('confirmando_id')
                ->constrained('confirmandos')
                ->cascadeOnDelete();

            // Confirmando
            $table->boolean('dni_confirmando')->default(false);
            $table->boolean('partida_bautizo')->default(false);

            // Padrino / Madrina
            $table->boolean('dni_padrino')->default(false);
            $table->boolean('constancia_confirmacion')->default(false);
            $table->boolean('partida_matrimonio_religioso')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
