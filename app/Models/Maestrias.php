<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestrias extends Model
{
    use HasFactory;
    protected $table = 'maestrias'; // Especifica el nombre de la tabla
    protected $primaryKey = 'id_maestria'; // Especifica la clave primaria
    public $timestamps = false;
}
