<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comunidad extends Model
{
    use HasFactory;

    protected $table = 'comunidades';

    protected $fillable = [
        'nombre',
        'comentario_coordinacion'

    ];

    // Ejemplo: una comunidad puede tener muchos confirmandos
    public function confirmandos()
    {
        return $this->hasMany(Confirmando::class);
    }

    public function guias()
    {
        return $this->hasMany(Guia::class, 'comunidad_id');
    }
    
}
