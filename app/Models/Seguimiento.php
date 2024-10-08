<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    const table = 'preguntas_seguimiento';
    protected $table = 'preguntas_seguimiento';

    protected $primaryKey = 'id_pregunta';

    protected $fillable = [
        'id_pregunta'
    ];

    public function getIdPreguntaAttribute()
    {
        return $this->attributes['id_pregunta'];
    }

    public function setIdPreguntaAttribute($value)
    {
        $this->attributes['id_pregunta'] = $value;
    }

    public function getPreguntaAttribute()
    {
        return $this->attributes['pregunta'];
    }

    public function setPreguntaAttribute($value)
    {
        $this->attributes['pregunta'] = $value;
    }
}
