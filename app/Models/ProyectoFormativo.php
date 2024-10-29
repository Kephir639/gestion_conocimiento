<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoFormativo extends Model
{
    use HasFactory;
    protected $table = 'proyectos_formativos';
    protected $fillable = [
        'pro_for_nombre_proyecto',
        'pro_for_objetivo_general',
        'pro_for_descripcion_problema',
        'pro_for_descripcion_actividad',
        'pro_for_experiencia_aprendiz',
        'pro_for_dificultad_solucion',
        'pro_for_leccion_aprendida',
        'pro_for_recomendaciones',
        'pro_for_conclusiones',
    ];
}
