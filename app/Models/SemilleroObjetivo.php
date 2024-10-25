<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SemilleroObjetivo extends Model
{
    protected $table = 'semilleros_objetivos';
    protected $fillable = ['semillero_id', 'objetivo_especifico'];

    public function semillero()
    {
        return $this->belongsTo(Semilleros::class);
    }
}
