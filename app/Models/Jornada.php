<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    protected $fillable = ['fecha','tema'];

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
