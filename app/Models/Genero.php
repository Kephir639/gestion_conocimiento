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

    protected $fillable = [
        'id_genero',
        'genero',
    
    ];

    // Getter para id_genero
    public function getIdGenero()
    {
        return $this->attributes['id_genero'];
    }

    // Setter para id_genero
    public function setIdGenero($idGenero)
    {
        $this->attributes['id_genero'] = $idGenero;
    }

    // Getter para genero
    public function getGenero()
    {
        return $this->attributes['genero'];
    }

    // Setter para genero
    public function setGenero($genero)
    {
        $this->attributes['genero'] = $genero;
    }


}
