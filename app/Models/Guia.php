<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guia extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'telefono',       
        'comunidad_id',
        'tipo_cargo',
    ];

    /**
     * Relación: Un guía pertenece a una comunidad
     */
    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class,'comunidad_id');
    }
}

