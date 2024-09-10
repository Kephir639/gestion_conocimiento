<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;
    
    protected $table = 'generos'; // Especifica el nombre de la tabla
    protected $primaryKey = 'id_genero'; // Especifica la clave primaria
    public $timestamps = false;
}
