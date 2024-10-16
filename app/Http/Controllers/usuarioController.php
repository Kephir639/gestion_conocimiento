<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Departamentos;
use App\Models\Municipio;
use App\Models\Tipo_poblacion;
use App\Models\Genero;
use App\Models\Cargos;
use App\Models\Doctorados;
use App\Models\Maestrias;
use App\Models\Profesiones;
use Illuminate\Support\Facades\Auth;
use App\Models\Rol;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class usuarioController extends Controller
{
    public function showUsuarios(Request $request)
    {
        $usuario = User::table;
        $rol = Rol::table;
        $listaUsuarios = DB::table($usuario)
            ->join($rol, "$usuario.idRol", "=", "$rol.id_rol")
            ->select('id', 'name', 'apellidos', 'tipo_documento', 'identificacion', 'email', 'estado_usu', 'rol')
            ->paginate(10);
        $controladores = $request->controladores;

        return view('modals.usuarios.consultarUsuarios', [
            'listaUsuarios' => $listaUsuarios,
            'controladores' => $controladores
        ]);
    }

    public function showModalRegistrar()
    {
        return view('modals.usuario.crearUsuario');
    }

    public function showModalActualizar()
    {
        return view('modals.usuario.modificarUsuario');
    }

    public function registrarUsuario(Request $request)
    {
        $reglas = [
            //'idRol' => 'required|integer',
            'name' => 'required|max:30',
            'apellidos' => 'required|max:30',
            'tipo_documento' => 'required|in:CC,TI,CE,Pasaporte,PEP,PPT',
            'numero_identificacion' => 'required|max:20|unique:users,numero_identificacion',
            'id_genero' => 'required|integer',
            'id_tipo' => 'required|integer',
            'email' => 'required|email|max:255',
            'celular' => 'required|max:15',
            'id_departamento' => 'required|integer',
            'id_municipio' => 'required|integer',
            'direccion' => 'required',
            'id_cargo' => 'required|integer',
            'id_profesion' => 'nullable|integer',
            'id_maestria' => 'nullable|integer',
            'id_doctorado' => 'nullable|integer',
            'Nombre_programa' => 'required',
            'ficha' => 'required|integer',
            'semillero_id' => 'nullable|integer',
            'password' => 'required|max:20'
        ];

        $mensajes = [
            'name.required' => 'Este campo es obligatorio',
            'name.max' => 'El campo debe contener máximo 30 caracteres',
            'apellidos.required' => 'Este campo es obligatorio',
            'apellidos.max' => 'El campo debe contener máximo 30 caracteres',
            'tipo_documento.required' => 'Este campo es obligatorio',
            'tipo_documento.in' => 'El tipo de documento no es válido',
            'numero_identificacion.required' => 'Este campo es obligatorio',
            'numero_identificacion.max' => 'El campo debe contener máximo 20 caracteres',
            'numero_identificacion.unique' => 'Este número de identificación ya está registrado',
            'id_genero.required' => 'Este campo es obligatorio',
            'id_genero.integer' => 'El campo debe ser un número entero',
            'id_tipo.required' => 'Este campo es obligatorio',
            'id_tipo.integer' => 'El campo debe ser un número entero',
            'email.required' => 'Este campo es obligatorio',
            'email.email' => 'Esta no es una dirección de correo electrónico válida',
            'email.max' => 'Este campo debe contener máximo 255 caracteres',
            'email.unique' => 'Este correo electrónico ya está registrado',
            'celular.required' => 'Este campo es obligatorio',
            'celular.max' => 'El campo debe contener máximo 15 caracteres',
            'id_departamento.required' => 'Este campo es obligatorio',
            'id_departamento.integer' => 'El campo debe ser un número entero',
            'id_municipio.required' => 'Este campo es obligatorio',
            'id_municipio.integer' => 'El campo debe ser un número entero',
            'direccion.required' => 'Este campo es obligatorio',
            'id_cargo.required' => 'Este campo es obligatorio',
            'id_cargo.integer' => 'El campo debe ser un número entero',
            'id_profesion.integer' => 'El campo debe ser un número entero',
            'id_maestria.integer' => 'El campo debe ser un número entero',
            'id_doctorado.integer' => 'El campo debe ser un número entero',
            'Nombre_programa.required' => 'Este campo es obligatorio',
            'ficha.required' => 'Este campo es obligatorio',
            'ficha.integer' => 'El campo debe ser un número entero',
            'password.required' => 'Este campo es obligatorio',
            //'password.regex' => 'La contraseña debe contener mínimo 8 y máximo 15 caracteres: 1 Minúscula, 1 Mayúscula, 1 Número Entero, 1 Carácter Especial'
        ];

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            if (User::where('numero_identificacion', $datos['numero_identificacion'])->exists()) {
                return view('alertas.repetido')->render();
            } else {
                $usuario = new User();
                //$usuario->idRol = $request->idRol;
                $usuario->name = $request->name;
                $usuario->apellidos = $request->apellidos;
                $usuario->tipo_documento = $request->tipo_documento;
                $usuario->numero_identificacion = $request->numero_identificacion;
                $usuario->id_genero = $request->id_genero;
                $usuario->id_tipo = $request->id_tipo;
                $usuario->email = $request->email;
                $usuario->celular = $request->celular;
                $usuario->id_departamento = $request->id_departamento;
                $usuario->id_municipio = $request->id_municipio;
                $usuario->direccion = $request->direccion;
                $usuario->id_cargo = $request->id_cargo;
                $usuario->id_profesion = $request->id_profesion;
                $usuario->id_maestria = $request->id_maestria;
                $usuario->id_doctorado = $request->id_doctorado;
                $usuario->Nombre_programa = $request->Nombre_programa;
                $usuario->ficha = $request->ficha;
                $usuario->semillero_id = $request->semillero_id;
                $usuario->password = Hash::make($request->password);
                $usuario->estado_usu = in_array($request->id_cargo, ['Aprendiz', 'Dinamizador SENNOVA', 'Auditor']) ? 1 : 0;

                $usuario->save();

                if ($request->has('semilleros')) {
                    foreach ($request->semilleros as $semillero) {
                        DB::table('semilleros_has_user')->insert([
                            'id' => $usuario->id,
                            'id_semillero' => $semillero,
                            'estado_shu' => 0
                        ]);
                    }
                }

                $listausuarios = User::orderBy('id', 'desc')->paginate(10);
                $controladores = $request->controladores;

                $tabla = view('modals.usuarios.tablaUsuario', [
                    'listaUsuarios' => $listausuarios,
                    'controladores' => $controladores
                ])->render();

                $alerta = view('alertas.registrarExitoso')->render();

                return response()->json([
                    'tabla' => $tabla,
                    'alerta' => $alerta
                ]);
            }
        }
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

    public function showPerfil()
    {

        return view('modals.usuarios.perfil.verPerfil');
    }

    public function actualizarPerfil(Request $request)
    {
        $reglas = [
            //'idRol' => 'required|integer',
            'name' => 'required|max:30',
            'apellidos' => 'required|max:30',
            'tipo_documento' => 'required|in:CC,TI,CE,Pasaporte,PEP,PPT',
            'numero_identificacion' => 'required|max:20|unique:users,numero_identificacion',
            'id_genero' => 'required|integer',
            'id_tipo' => 'required|integer',
            'email' => 'required|email|max:255',
            'celular' => 'required|max:15',
            'id_departamento' => 'required|integer',
            'id_municipio' => 'required|integer',
            'direccion' => 'required',
            'id_cargo' => 'required|integer',
            'id_profesion' => 'nullable|integer',
            'id_maestria' => 'nullable|integer',
            'id_doctorado' => 'nullable|integer',
            'Nombre_programa' => 'required',
            'ficha' => 'required|integer',
            'semillero_id' => 'nullable|integer',
            'password' => 'required|max:20'
        ];

        $mensajes = [
            'name.required' => 'Este campo es obligatorio',
            'name.max' => 'El campo debe contener máximo 30 caracteres',
            'apellidos.required' => 'Este campo es obligatorio',
            'apellidos.max' => 'El campo debe contener máximo 30 caracteres',
            'tipo_documento.required' => 'Este campo es obligatorio',
            'tipo_documento.in' => 'El tipo de documento no es válido',
            'numero_identificacion.required' => 'Este campo es obligatorio',
            'numero_identificacion.max' => 'El campo debe contener máximo 20 caracteres',
            'numero_identificacion.unique' => 'Este número de identificación ya está registrado',
            'id_genero.required' => 'Este campo es obligatorio',
            'id_genero.integer' => 'El campo debe ser un número entero',
            'id_tipo.required' => 'Este campo es obligatorio',
            'id_tipo.integer' => 'El campo debe ser un número entero',
            'email.required' => 'Este campo es obligatorio',
            'email.email' => 'Esta no es una dirección de correo electrónico válida',
            'email.max' => 'Este campo debe contener máximo 255 caracteres',
            'email.unique' => 'Este correo electrónico ya está registrado',
            'celular.required' => 'Este campo es obligatorio',
            'celular.max' => 'El campo debe contener máximo 15 caracteres',
            'id_departamento.required' => 'Este campo es obligatorio',
            'id_departamento.integer' => 'El campo debe ser un número entero',
            'id_municipio.required' => 'Este campo es obligatorio',
            'id_municipio.integer' => 'El campo debe ser un número entero',
            'direccion.required' => 'Este campo es obligatorio',
            'id_cargo.required' => 'Este campo es obligatorio',
            'id_cargo.integer' => 'El campo debe ser un número entero',
            'id_profesion.integer' => 'El campo debe ser un número entero',
            'id_maestria.integer' => 'El campo debe ser un número entero',
            'id_doctorado.integer' => 'El campo debe ser un número entero',
            'Nombre_programa.required' => 'Este campo es obligatorio',
            'ficha.required' => 'Este campo es obligatorio',
            'ficha.integer' => 'El campo debe ser un número entero',
            'password.required' => 'Este campo es obligatorio',
            //'password.regex' => 'La contraseña debe contener mínimo 8 y máximo 15 caracteres: 1 Minúscula, 1 Mayúscula, 1 Número Entero, 1 Carácter Especial'
        ];

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            if (User::where('numero_identificacion', $datos['numero_identificacion'])->exists()) {
                return view('alertas.repetido')->render();
            } else {
                $usuario = new User();
                //$usuario->idRol = $request->idRol;
                $usuario->name = $request->name;
                $usuario->apellidos = $request->apellidos;
                $usuario->tipo_documento = $request->tipo_documento;
                $usuario->identificacion = $request->identificacion;
                $usuario->id_genero = $request->id_genero;
                $usuario->id_tipo = $request->id_tipo;
                $usuario->email = $request->email;
                $usuario->celular = $request->celular;
                $usuario->id_departamento = $request->id_departamento;
                $usuario->id_municipio = $request->id_municipio;
                $usuario->direccion = $request->direccion;
                $usuario->id_cargo = $request->id_cargo;
                $usuario->id_profesion = $request->id_profesion;
                $usuario->id_maestria = $request->id_maestria;
                $usuario->id_doctorado = $request->id_doctorado;
                $usuario->Nombre_programa = $request->Nombre_programa;
                $usuario->ficha = $request->ficha;
                $usuario->semillero_id = $request->semillero_id;
                $usuario->password = Hash::make($request->password);
                $usuario->estado_usu = in_array($request->id_cargo, ['Aprendiz', 'Dinamizador SENNOVA', 'Auditor']) ? 1 : 0;

                $actualizado = user::where('identificacion', Auth::user()->identificacion)->update($usuario->toArray());

                $listausuarios = User::orderBy('id', 'desc')->paginate(10);
                $controladores = $request->controladores;

                $tabla = view('modals.usuarios.tablaUsuario', [
                    'listaUsuarios' => $listausuarios,
                    'controladores' => $controladores
                ])->render();

                $alerta = view('alertas.registrarExitoso')->render();

                return response()->json([
                    'tabla' => $tabla,
                    'alerta' => $alerta
                ]);
            }
        }
    }

    public function editarUsuario(Request $request)
    {
        $datos = $request->all();

        $reglas = [
            'id_rol' => 'required',
            'estado_usu' => 'required'
        ];

        $mensajes = [
            'id_rol.required' => 'Este campo es obligatorio',
            'estado_usu.required' => 'Esto campo es obligatorio'
        ];

        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = User::where('numero_identificacion', $request->documento)->first();
            if (count($ajax)) {
                return view('alertas.repetido')->render();
            } else {
                $user = new User();
                $user->idRol = $request->id_rol;
                $user->estado_usu = $request->estado_usu;

                User::where('numero_identificacion', $request->documento)->update($user->toArray());

                return view('alertas.modificarExitoso')->render();
            }
        }
    }

    public function usersExport()
    {
        return Excel::download(new UsersExport, 'usuarios.xlsx');
    }
}
