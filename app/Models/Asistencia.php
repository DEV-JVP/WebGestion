<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = ['confirmando_id','jornada_id','estado'];

    public function confirmando()
    {
        return $this->belongsTo(Confirmando::class);
    }

    public function jornada()
    {
        return $this->belongsTo(Jornada::class);
    }
}
