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
        Schema::create('confirmandos', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 15)->unique();
            $table->string('nombre');
            $table->string('colegio')->nullable();
            $table->string('capilla_cercana')->nullable();
            $table->string('direccion')->nullable();
            $table->string('contacto_emergencia')->nullable();          
            $table->string('nombre_padre')->nullable();
            $table->string('telefono_padre')->nullable();
            $table->string('nombre_madre')->nullable();
            $table->string('telefono_madre')->nullable();          
            $table->text('observaciones')->nullable();

             $table->string('situacion_matrimonial_padres')->nullable();
            $table->string('situacion_matrimonial_comentario')->nullable();
            $table->string('tipo_sangre', 5)->nullable();
            $table->text('alergias')->nullable();

            
            $table->foreignId('comunidad_id')->nullable()->constrained('comunidades')->nullOnDelete();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirmandos');
    }
};
