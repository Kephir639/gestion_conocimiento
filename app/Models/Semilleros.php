<?php
// app/Models/Semillero.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Semilleros extends Model
{
    protected $table = 'semilleros_investigacion';

    protected $primaryKey = 'id_semillero';

    protected $fillable = [
        'nombre_semillero',
        'iniciales_semillero',
        'fecha_creacion',
        'mision',
        'vision',
        'objetivo_general',
        'objetivos_especificos',
        'id_grupo',
        'id_plan',
        'estado_semillero',
    ];

    protected $casts = [
        'fecha_creacion' => 'date',
    ];

    public function getIdSemilleroAttribute()
    {
        return $this->attributes['id_semillero'];
    }

    public function setIdSemilleroAttribute($value)
    {
        $this->attributes['id_semillero'] = (int) $value;
    }

    public function getNombreSemilleroAttribute()
    {
        return $this->attributes['nombre_semillero'];
    }

    public function setNombreSemilleroAttribute($value)
    {
        $this->attributes['nombre_semillero'] = ucfirst($value);
    }

    public function getInicialesSemilleroAttribute()
    {
        return $this->attributes['iniciales_semillero'];
    }

    public function setInicialesSemilleroAttribute($value)
    {
        $this->attributes['iniciales_semillero'] = strtoupper($value);
    }

    public function getFechaCreacionAttribute()
    {
        return $this->attributes['fecha_creacion'];
    }

    public function setFechaCreacionAttribute($value)
    {
        $this->attributes['fecha_creacion'] = \Carbon\Carbon::parse($value);
    }

    public function getMisionAttribute()
    {
        return $this->attributes['mision'];
    }

    public function setMisionAttribute($value)
    {
        $this->attributes['mision'] = $value;
    }

    public function getVisionAttribute()
    {
        return $this->attributes['vision'];
    }

    public function setVisionAttribute($value)
    {
        $this->attributes['vision'] = $value;
    }

    public function getObjetivoGeneralAttribute()
    {
        return $this->attributes['objetivo_general'];
    }

    public function setObjetivoGeneralAttribute($value)
    {
        $this->attributes['objetivo_general'] = ucfirst($value);
    }

    public function getObjetivosEspecificosAttribute()
    {
        return $this->attributes['objetivos_especificos'];
    }

    public function setObjetivosEspecificosAttribute($value)
    {
        $this->attributes['objetivos_especificos'] = $value;
    }

    public function getIdGrupoAttribute()
    {
        return $this->attributes['id_grupo'];
    }

    public function setIdGrupoAttribute($value)
    {
        $this->attributes['id_grupo'] = (int) $value;
    }

    public function getIdPlanAttribute()
    {
        return $this->attributes['id_plan'];
    }

    public function setIdPlanAttribute($value)
    {
        $this->attributes['id_plan'] = (int) $value;
    }

    public function getEstadoSemilleroAttribute()
    {
        return $this->attributes['id_plan'];
    }

    public function setEstadoSemilleroAttribute($value)
    {
        $this->attributes['estado_semillero'] = (int) $value;
    }
}
