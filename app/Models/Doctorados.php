<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctorados extends Model
{
    use HasFactory;
    protected $table = 'doctorados'; // Especifica el nombre de la tabla
    protected $primaryKey = 'id_doctorado'; // Especifica la clave primaria
    public $timestamps = false;
}
