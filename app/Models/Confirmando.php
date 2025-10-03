<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confirmando extends Model
{
    protected $fillable = [
        'dni',
        'nombre',
        'colegio',
        'capilla_cercana',
        'direccion',
        'contacto_emergencia',
        'observaciones',
        'nombre_padre',
        'telefono_padre',
        'nombre_madre',
        'telefono_madre',
        'comunidad_id',
        'situacion_matrimonial_padres',
        'situacion_matrimonial_comentario',
        'tipo_sangre',
        'alergias',
    ];

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class);
    }

    public function sacramentos()
    {
        return $this->belongsToMany(Sacramento::class, 'confirmando_sacramento');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}
