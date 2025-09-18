<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\redprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guias', function (redprint $table) {
            $table->id();
            $table->foreignId('comunidad_id')->constrained('comunidades')->cascadeOnDelete();
            $table->string('nombre');
            $table->string('telefono')->nullable();           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guias');
    }
};
