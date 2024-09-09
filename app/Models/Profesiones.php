<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesiones extends Model
{
    use HasFactory;
    protected $table = 'profesiones'; // Especifica el nombre de la tabla
    protected $primaryKey = 'id_profesion'; // Especifica la clave primaria
    public $timestamps = false;
}
