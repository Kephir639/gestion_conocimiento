<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargos extends Model
{
    use HasFactory;
    protected $table = 'cargos'; // Especifica el nombre de la tabla
    protected $primaryKey = 'id_cargo'; // Especifica la clave primaria
    public $timestamps = false;
}
