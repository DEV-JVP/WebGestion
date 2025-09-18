<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
        'confirmando_id',
        'monto',
        'fecha',
        'boleta',
        'tipo',
        'observacion',
    ];

    public function confirmando()
    {
        return $this->belongsTo(Confirmando::class);
    }
}
