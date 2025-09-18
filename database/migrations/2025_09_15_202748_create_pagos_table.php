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
        Schema::create('pagos', function (redprint $table) {
            $table->id();
            $table->foreignId('confirmando_id')->constrained('confirmandos')->onDelete('cascade');
            $table->decimal('monto', 10, 2);
            $table->date('fecha');
            $table->string('boleta')->nullable();
            $table->enum('tipo', ['inscripcion', 'mensualidad', 'extraordinario']);
            $table->text('observacion')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
