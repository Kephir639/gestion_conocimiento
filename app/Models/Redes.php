<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redes extends Model
{
    use HasFactory;

    protected $table = 'redes_conocimiento';
    protected $primaryKey = 'id_Red';

    protected $fillable = [
        'id_Red',
        'nombre_red',
        'estado_red'
    ];

    public function getIdRedAttribute()
    {
        return $this->attributes['id_Red'];
    }

    public function setIdRedAttribute($value)
    {
        return $this->attributes['id_Red'] = $value;
    }

    public function getNombreRedAttribute()
    {
        return $this->attributes['nombre_red'];
    }

    public function setNombreRedAttribute($value)
    {
        return $this->attributes['nombre_red'] = $value;
    }

    public function getEstadoRedAttribute()
    {
        return $this->attributes['estado_red'];
    }

    public function setEstadoRedAttribute($value)
    {
        return $this->attributes['estado_red'] = $value;
    }
}
