<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_poblacion extends Model
{
    use HasFactory;

    protected $table = 'tipos_poblaciones'; // Especifica el nombre de la tabla
    protected $primaryKey = 'id_tipo'; // Especifica la clave primaria
    public $timestamps = false;
}
