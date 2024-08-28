<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos';
    protected $fillable = [
        'id_permiso',
        'id_rol',
        'id_funcion'
    ];

    public function getIdPermisoAttribute()
    {
        return $this->attributes['id_permiso'];
    }

    public function setIdPermisoAttribute($value)
    {
        return $this->attributes['id_permiso'] = $value;
    }

    public function getIdRolAttribute()
    {
        return $this->attributes['id_rol'];
    }

    public function setIdRolAttribute($value)
    {
        return $this->attributes['id_rol'] = $value;
    }

    public function getIdFuncionAttribute()
    {
        return $this->attributes['id_funcion'];
    }

    public function setIdFuncionAttribute($value)
    {
        return $this->attributes['id_funcion'] = $value;
    }
}
