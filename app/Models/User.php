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
    const table = 'users';
    protected $table = 'users';
    protected $fillable = [
        'id',
        'idRol',
        'name',
        'password',
        'apellidos',
        'tipo_documento',
        'identificacion',
        'id_genero',
        'id_tipo_poblacion',
        'email',
        'celular',
        'id_municipio',
        'direccion',
        'id_cargo',
        'id_profesion',
        'id_doctorado',
        'nombre_programa',
        'ficha',
        'id_semillero',
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

    public function getId()
    {
        return $this->attributes['id'];
    }
    // Getters
    public function getIdRolAttribute()
    {
        return $this->attributes['idRol'];
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'];
    }

    public function getEmailAttribute()

    {
        return $this->attributes['email'];
    }

    public function getPasswordAttribute()
    {
        return $this->attributes['password'];
    }

    public function getApellidosAttribute()
    {
        return $this->attributes['apellidos'];
    }

    public function getIdentificacionAttribute()
    {
        return $this->attributes['identificacion'];
    }

    public function getIdGeneroAttribute()
    {
        return $this->attributes['id_genero'];
    }

    public function getIdTipoPoblacionAttribute()
    {
        return $this->attributes['id_tipo_poblacion'];
    }

    public function getCelularAttribute()
    {
        return $this->attributes['celular'];
    }

    public function getIdMunicipioAttribute()
    {
        return $this->attributes['id_municipio'];
    }

    public function getDireccionAttribute()
    {
        return $this->attributes['direccion'];
    }

    public function getIdCargoAttribute()
    {
        return $this->attributes['id_cargo'];
    }

    public function getIdProgramaAttribute()
    {
        return $this->attributes['id_programa'];
    }

    public function getEstadoUsuAttribute()
    {
        return $this->attributes['estado_usu'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    // Setters
    public function setIdRolAttribute($idRol)
    {
        $this->attributes['id_rol'] = $idRol;
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
    }

    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = $email;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = $password;
    }

    public function setApellidosAttribute($apellidos)
    {
        $this->attributes['apellidos'] = $apellidos;
    }

    public function setIdentificacionAttribute($identificacion)
    {
        $this->attributes['identificacion'] = $identificacion;
    }

    public function setIdGeneroAttribute($idGenero)
    {
        $this->attributes['id_genero'] = $idGenero;
    }

    public function setIdTipoPoblacionAttribute($idTipoPoblacion)
    {
        $this->attributes['id_tipo_poblacion'] = $idTipoPoblacion;
    }

    public function setCelularAttribute($celular)
    {
        $this->attributes['celular'] = $celular;
    }

    public function setIdMunicipioAttribute($idMunicipio)
    {
        $this->attributes['id_municipio'] = $idMunicipio;
    }

    public function setDireccionAttribute($direccion)
    {
        $this->attributes['direccion'] = $direccion;
    }

    public function setIdCargoAttribute($idCargo)
    {
        $this->attributes['id_cargo'] = $idCargo;
    }

    public function setIdProgramaAttribute($idPrograma)
    {
        $this->attributes['id_programa'] = $idPrograma;
    }

    public function setEstadoUsuAttribute($estadoUsu)
    {
        $this->attributes['estado_usu'] = $estadoUsu;
    }
}
