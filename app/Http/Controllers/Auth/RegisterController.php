<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Departamentos;
use App\Models\Municipio;
use App\Models\Tipo_poblacion;
use App\Models\Genero;
use App\Models\Cargos;
use App\Models\Doctorados;
use App\Models\Maestrias;
use App\Models\Profesiones;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'tipo_documento' => ['required', 'string'],
            'numero_identificacion' => ['required', 'string', 'min:8', 'unique:users,numero_identificacion'],
            'genero' => ['required', 'exists:generos,id_genero'],
            'tipo_poblacion' => ['required', 'exists:tipos_poblaciones,id_tipo'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'celular' => ['required', 'string', 'min:10', 'max:10'],
            'departamento' => ['required', 'exists:departamentos,id_departamento'],
            'municipio' => ['required', 'exists:municipios,id_municipio'],
            'direccion' => ['required', 'string', 'max:255'],
            'cargo' => ['required', 'exists:cargos,id_cargo'],
            'maestria' => ['nullable', 'exists:maestrias,id_maestria'],
            'profesion' => ['nullable', 'exists:profesiones,id_profesion'],
            'doctorado' => ['nullable', 'exists:doctorados,id_doctorado'],
            'programa_ficha' => ['nullable', 'string'],
            'ficha' => ['nullable', 'string'],
            'semillero' => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    protected function create($data)
    {
        return User::create([
            'name' => $data['name'],
            'apellidos' => $data['apellidos'],
            'password' => Hash::make($data['password']),
            'tipo_documento' => $data['tipo_documento'],
            'numero_identificacion' => $data['numero_identificacion'],
            'id_genero' => $data['genero'],
            'id_tipo' => $data['tipo_poblacion'],
            'correo' => $data['email'],
            'celular' => $data['celular'],
            'id_departamento' => $data['departamento'],
            'id_municipio' => $data['municipio'],
            'direccion' => $data['direccion'],
            'id_cargo' => $data['cargo'],
            'id_maestria' => $data['maestria'] ?? null,
            'id_profesion' => $data['profesion'] ?? null,
            'id_doctorado' => $data['doctorado'] ?? null,
            'Nombre_programa' => $data['programa_ficha'] ?? null,
            'ficha' => $data['ficha'] ?? null,
            'semillero' => $data['semillero'] ?? null,
        ]);
    }

    public function showRegistrationForm()
    {
        $departamentos = Departamentos::all();
        $municipios = Municipio::all();
        $tipo_poblaciones = Tipo_poblacion::all();
        $generos = Genero::all();
        $cargos = Cargos::all();
        $profesiones = Profesiones::all();
        $maestrias = Maestrias::all();
        $doctorados = Doctorados::all();

        return view('Auth.register', compact('departamentos', 'municipios', 'tipo_poblaciones', 'generos', 'cargos', 'profesiones', 'maestrias', 'doctorados'));
    }

    public function getMunicipiosByDepartamento($departamento_id)
    {
        $municipios = Municipio::where('departamento_id', $departamento_id)->get();
        return response()->json($municipios);
    }
}
