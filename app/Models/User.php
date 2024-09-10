<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'idRol',
        'name',
        'email',
        'password',
        'apellidos',
        'identificacion',
        'id_genero',
        'id_tipo_poblacion',
        'celular',
        'id_municipio',
        'direccion',
        'id_cargo',
        'id_programa',
        'estado_usu',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    // Getters
    // public function getIdRolAttribute()
    // {
    //     return $this->attributes['idRol'];
    // }

    // public function getNameAttribute()
    // {
    //     return $this->attributes['name'];
    // }

    // public function getEmailAttribute()

    // {
    //     return $this->attributes['email'];
    // }

    // public function getPasswordAttribute()
    // {
    //     return $this->attributes['password'];
    // }

    // public function getApellidosAttribute()
    // {
    //     return $this->apellidos;
    // }

    // public function getIdentificacionAttribute()
    // {
    //     return $this->identificacion;
    // }

    // public function getIdGeneroAttribute()
    // {
    //     return $this->id_genero;
    // }

    // public function getIdTipoPoblacionAttribute()
    // {
    //     return $this->id_tipo_poblacion;
    // }

    // public function getCelularAttribute()
    // {
    //     return $this->celular;
    // }

    // public function getIdMunicipioAttribute()
    // {
    //     return $this->id_municipio;
    // }

    // public function getDireccionAttribute()
    // {
    //     return $this->direccion;
    // }

    // public function getIdCargoAttribute()
    // {
    //     return $this->id_cargo;
    // }

    // public function getIdProgramaAttribute()
    // {
    //     return $this->id_programa;
    // }

    public function getEstadoUsuAttribute()
    {
        return $this->attributes['estado_usu'];
    }

    // // Setters
    // public function setIdRolAttribute($idRol)
    // {
    //     $this->id_rol = $idRol;
    // }

    // public function setNameAttribute($name)
    // {
    //     $this->name = $name;
    // }

    // public function setEmailAttribute($email)
    // {
    //     $this->email = $email;
    // }

    // public function setPasswordAttribute($password)
    // {
    //     $this->password = bcrypt($password); // assuming you want to hash the password
    // }

    // public function setApellidosAttribute($apellidos)
    // {
    //     $this->apellidos = $apellidos;
    // }

    // public function setIdentificacionAttribute($identificacion)
    // {
    //     $this->identificacion = $identificacion;
    // }

    // public function setIdGeneroAttribute($idGenero)
    // {
    //     $this->id_genero = $idGenero;
    // }

    // public function setIdTipoPoblacionAttribute($idTipoPoblacion)
    // {
    //     $this->id_tipo_poblacion = $idTipoPoblacion;
    // }

    // public function setCelularAttribute($celular)
    // {
    //     $this->celular = $celular;
    // }

    // public function setIdMunicipioAttribute($idMunicipio)
    // {
    //     $this->id_municipio = $idMunicipio;
    // }

    // public function setDireccionAttribute($direccion)
    // {
    //     $this->direccion = $direccion;
    // }

    // public function setIdCargoAttribute($idCargo)
    // {
    //     $this->id_cargo = $idCargo;
    // }

    // public function setIdProgramaAttribute($idPrograma)
    // {
    //     $this->id_programa = $idPrograma;
    // }

    // public function setEstadoUsuAttribute($estadoUsu)
    // {
    //     $this->attributes['estado_usu'] = $estadoUsu;
    // }
}
