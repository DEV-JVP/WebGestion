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
        Schema::create('confirmando_sacramento', function (redprint $table) {
            $table->id();
            $table->foreignId('confirmando_id')->constrained('confirmandos')->onDelete('cascade');
            $table->foreignId('sacramento_id')->constrained('sacramentos')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirmando_sacramento');
    }
};
