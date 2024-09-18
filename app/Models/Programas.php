<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programas extends Model
{
    use HasFactory;

    protected $table = 'programas_formacion';

    protected $fillable = [
        'id_programa',
        'numero_ficha',
        'nombre_programa',
        'estado_programa'
    ];

    // Getters
    public function getIdProgramaAttribute()
    {
        return $this->attributes['id_programa'];
    }

    public function getNumeroFichaAttribute()
    {
        return $this->attributes['numero_ficha'];
    }

    public function getNombreProgramaAttribute()
    {
        return $this->attributes['nombre_programa'];
    }

    public function getEstadoProgramaAttribute()
    {
        return $this->attributes['estado_programa'];
    }

    // Setters
    public function setIdProgramaAttribute($value)
    {
        $this->attributes['id_programa'] = $value;
    }

    public function setNumeroFichaAttribute($value)
    {
        $this->attributes['numero_ficha'] = $value;
    }

    public function setNombreProgramaAttribute($value)
    {
        $this->attributes['nombre_programa'] = $value;
    }

    public function setEstadoProgramaAttribute($value)
    {
        $this->attributes['estado_programa'] = $value;
    }
}
