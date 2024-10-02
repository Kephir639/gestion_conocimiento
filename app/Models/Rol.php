<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    const table = 'roles';
    protected $table = 'roles';

    // Define the primary key for the model
    protected $primaryKey = 'id_rol';

    // Define the fillable properties
    protected $fillable = [
        'id_rol',
        'rol',
        'estado_rol'
    ];

    // Getters and setters
    public function getIdRolAttribute()
    {
        return $this->attributes['id_rol'];
    }

    public function setIdRolAttribute($value)
    {
        $this->attributes['id_rol'] = $value;
    }

    public function getRolAttribute()
    {
        return $this->attributes['rol'];
    }

    public function setRolAttribute($value)
    {
        $this->attributes['rol'] = $value;
    }

    public function getEstadoRolAttribute()
    {
        return $this->attributes['estado_rol'];
    }

    public function setEstadoRolAttribute($value)
    {
        $this->attributes['estado_rol'] = $value;
    }
}
