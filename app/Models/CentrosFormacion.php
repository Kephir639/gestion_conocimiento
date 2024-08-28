<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentrosFormacion extends Model
{
    use HasFactory;

    protected $table = 'centro_formacion';
    protected $primaryKey = 'id_centro';
    protected $fillable = [
        'id_centro',
        'codigo_centro',
        'nombre_centro',
        'estado_centro'
    ];

    public function getIdCentroAttribute()
    {
        return $this->attributes['id_centro'];
    }

    public function setIdCentroAttribute($value)
    {
        return $this->attributes['id_centro'] = $value;
    }

    public function getNombreCentroAttribute()
    {
        return $this->attributes['nombre_centro'];
    }

    public function setNombreCentroAttribute($value)
    {
        return $this->attributes['nombre_centro'] = $value;
    }

    public function getCodigoCentroAttribute()
    {
        return $this->attributes['codigo_centro'];
    }

    public function setCodigoCentroAttribute($value)
    {
        return $this->attributes['codigo_centro'] = $value;
    }

    public function getEstadoCentroAttribute()
    {
        return $this->attributes['estado_centro'];
    }

    public function setEstadoCentroAttribute($value)
    {
        return $this->attributes['estado_centro'] = $value;
    }
}
