<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sacramento extends Model
{
    protected $fillable = ['nombre'];

    public function confirmandos()
    {
        return $this->belongsToMany(Confirmando::class, 'confirmando_sacramento');
    }
}

