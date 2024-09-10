<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log_auditoria';

    protected $fillable = [
        'accion_realizada',
        'fecha_realizacion',
        'nombre_responsable',
        'documento_responsable'
    ];


    use HasFactory;
}
