<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaInvestigacion extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'lineas_investigacion';

    // Nombre de la clave primaria
    protected $primaryKey = 'id_linea';

    // Los atributos que son asignables
    protected $fillable = [
        'id_linea',
        'nombre_linea',
        'estado_linea',
        'created_at',
        'updated_at'
    ];

    // Getters y setters
    public function getIdLineaAttribute()
    {
        return $this->attributes['id_linea'];
    }

    public function setIdLineaAttribute($value)
    {
        $this->attributes['id_linea'] = $value;
    }

    public function getNombreLineaAttribute()
    {
        return $this->attributes['nombre_linea'];
    }

    public function setNombreLineaAttribute($value)
    {
        $this->attributes['nombre_linea'] = $value;
    }

    public function getEstadoAttribute()
    {
        return $this->attributes['estado_linea'];
    }

    public function setEstadoAttribute($value)
    {
        $this->attributes['estado_linea'] = $value;
    }
}
