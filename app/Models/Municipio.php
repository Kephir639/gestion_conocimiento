<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'municipios'; // Especifica el nombre de la tabla
    protected $primaryKey = 'id_municipio'; // Especifica la clave primaria
    public $timestamps = false; // Indica que no se usan timestamps

    // Si necesitas definir otros atributos adicionales, puedes hacerlo aquí
}
