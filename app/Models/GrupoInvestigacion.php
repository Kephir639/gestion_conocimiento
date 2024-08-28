<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoInvestigacion extends Model
{
    use HasFactory;
    protected $table = 'grupos_investigacion';
    protected $primaryKey = 'id_grupo';
    protected $fillable = [
        'id_grupo',
        'nombre_grupo',
        'estado_grupo'
    ];

    public function getIdGrupoAttribute()
    {
        return $this->attributes['id_grupo'];
    }

    public function setIdGrupoAttribute($value)
    {
        return $this->attributes['id_grupo'] = $value;
    }

    public function getNombreGrupoAttribute()
    {
        return $this->attributes['nombre_grupo'];
    }

    public function setNombreGrupoAttribute($value)
    {
        return $this->attributes['nombre_grupo'] = $value;
    }

    public function getEstadoGrupoAttribute()
    {
        return $this->attributes['estado_grupo'];
    }

    public function setEstadoGrupoAttribute($value)
    {
        return $this->attributes['estado_grupo'] = $value;
    }
}
