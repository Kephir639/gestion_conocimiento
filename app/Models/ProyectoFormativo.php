<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoFormativo extends Model
{
    use HasFactory;
    protected $table = 'proyectos_formativos';
    protected $fillable = [
        'nombre_proyecto',
        'objetivo_general',
        'descripcion_problema',
        'descripcion_actividad',
        'experiencia_aprendiz',
        'dificultad_solucion',
        'leccion_aprendida',
        'recomendaciones',
        'conclusiones',
    ];

    // Getters y Setters para los atributos

    public function getNombreProyectoAttribute($value)
    {
        return $value; // Ejemplo de transformación
    }

    public function setNombreProyectoAttribute($value)
    {
        $this->attributes['nombre_proyecto'] = $value; // Sin transformación
    }

    public function getObjetivoGeneralAttribute($value)
    {
        return $value;
    }

    public function setObjetivoGeneralAttribute($value)
    {
        $this->attributes['objetivo_general'] = $value; // Sin transformación
    }

    public function getDescripcionProblemaAttribute($value)
    {
        return $value;
    }

    public function setDescripcionProblemaAttribute($value)
    {
        $this->attributes['descripcion_problema'] = $value; // Sin transformación
    }

    public function getDescripcionActividadAttribute($value)
    {
        return $value;
    }

    public function setDescripcionActividadAttribute($value)
    {
        $this->attributes['descripcion_actividad'] = $value; // Sin transformación
    }

    public function getExperienciaAprendizAttribute($value)
    {
        return $value;
    }

    public function setExperienciaAprendizAttribute($value)
    {
        $this->attributes['experiencia_aprendiz'] = $value; // Sin transformación
    }

    public function getDificultadSolucionAttribute($value)
    {
        return $value;
    }

    public function setDificultadSolucionAttribute($value)
    {
        $this->attributes['dificultad_solucion'] = $value; // Sin transformación
    }

    public function getLeccionAprendidaAttribute($value)
    {
        return $value;
    }

    public function setLeccionAprendidaAttribute($value)
    {
        $this->attributes['leccion_aprendida'] = $value; // Sin transformación
    }

    public function getRecomendacionesAttribute($value)
    {
        return $value;
    }

    public function setRecomendacionesAttribute($value)
    {
        $this->attributes['recomendaciones'] = $value; // Sin transformación
    }

    public function getConclusionesAttribute($value)
    {
        return $value;
    }

    public function setConclusionesAttribute($value)
    {
        $this->attributes['conclusiones'] = $value; // Sin transformación
    }
}
