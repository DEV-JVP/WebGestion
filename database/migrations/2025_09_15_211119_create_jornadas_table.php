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
        Schema::create('jornadas', function (redprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('tema');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jornadas');
    }
};
