<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'cargos';

    // Nombre de la clave primaria
    protected $primaryKey = 'id_cargo';

    // Los atributos que son asignables
    protected $fillable = [
        'id_cargo',
        'nombre_cargo',
        'estado_cargo',
        'created_at',
        'updated_at'
    ];

    // Getters y setters
    public function getIdCargoAttribute()
    {
        return $this->attributes['id_cargo'];
    }

    public function setIdCargoAttribute($value)
    {
        $this->attributes['id_cargo'] = $value;
    }

    public function getNombreCargoAttribute()
    {
        return $this->attributes['nombre_cargo'];
    }

    public function setNombreCargoAttribute($value)
    {
        $this->attributes['nombre_cargo'] = $value;
    }

    public function getEstadoAttribute()
    {
        return $this->attributes['estado_cargo'];
    }

    public function setEstadoAttribute($value)
    {
        $this->attributes['estado_cargo'] = $value;
    }
}
