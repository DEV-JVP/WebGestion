<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = [
        'confirmando_id',
        'dni_confirmando',
        'partida_bautizo',
        'dni_padrino',
        'constancia_confirmacion',
        'partida_matrimonio_religioso',
    ];

    public function confirmando()
    {
        return $this->belongsTo(Confirmando::class);
    }
}
