<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integrantes extends Model
{
    use HasFactory;

    protected $table = 'integrantes';

    protected $fillable = [
        'id_usuario',
        'id_semillero',
        'estado_integrantes'
    ];


    public function getIdUsuarioAttribute()
    {
        return $this->attributes['id_usuario'];
    }

    public function getIdSemilleroAttribute()
    {
        return $this->attributes['id_semillero'];
    }

    public function getEstadoIntegrantesAttribute()
    {
        return $this->attributes['estado_integrantes'];
    }

    public function setIdUsuarioAttribute($value)
    {
        $this->attributes['id_usuario'] = $value;
    }

    public function setIdSemilleroAttribute($value)
    {
        $this->attributes['id_semillero'] = $value;
    }

    public function setEstadoIntegrantesAttribute($value)
    {
        $this->attributes['estado_integrantes'] = $value;
    }
}
