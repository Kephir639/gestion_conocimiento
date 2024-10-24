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
use App\Models\Log;
use App\Models\Maestrias;
use App\Models\Profesiones;
use Illuminate\Support\Facades\Auth;
use App\Models\Rol;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class usuarioController extends Controller
{
    public function showUsuarios(Request $request) //Muestra la vista con los usuarios registrados en el sistema
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
        ]); //Se envia la modal al Ajax para ser mostrada
    }

    public function showRegistrationForm() //Mostrar la vista de registro
    {
        $generos = Genero::where('estado_genero', 1)->get();
        $tipo_poblaciones = Tipo_poblacion::where('estado_tp', 1)->get();
        $departamentos = Departamentos::where('estado_departamento', 1)->get();
        $municipios = Municipio::where('estado_municipio', 1)->get();
        $cargos = Cargos::where('estado_cargo', 1)->get();
        $profesiones = Profesiones::where('estado_profesion', 1)->get();
        $maestrias = Maestrias::where('estado_maestria', 1)->get();
        $doctorados = Doctorados::where('estado_doctorado', 1)->get();

        return view('Auth.register', compact('departamentos', 'municipios', 'tipo_poblaciones', 'generos', 'cargos', 'profesiones', 'maestrias', 'doctorados'));
    }

    public function registrarUsuario(Request $request) //Proceso de registro del usuario
    {
        $reglas = [
            'idRol' => 'nullable|integer',
            'name' => ['required', 'max:30', 'regex:/^[\pL\s]+$/u'], // Solo letras y espacios
            'apellidos' => ['required', 'max:30', 'regex:/^[\pL\s]+$/u'], // Solo letras y espacios
            'tipo_documento' => 'required|in:CC,TI,CE,Pasaporte,PEP,PPT',
            'identificacion' => ['required', 'max:20', 'regex:/^[0-9]+$/', 'unique:users,identificacion'], // Solo números
            'id_genero' => 'required|integer',
            'id_tipo' => 'required|integer',
            'email' => 'required|email|max:255|unique:users,email',
            'celular' => ['required', 'max:15', 'regex:/^[0-9]+$/'], // Solo números
            'id_departamento' => 'required|integer',
            'id_municipio' => 'required|integer',
            'direccion' => 'required|max:255',
            'id_cargo' => 'required|integer',
            'id_profesion' => 'nullable|integer',
            'id_maestria' => 'nullable|integer',
            'id_doctorado' => 'nullable|integer',
            'Nombre_programa' => 'nullable|max:255',
            'ficha' => 'nullable|integer',
            'semillero_id' => 'nullable|integer',
            'password' => [
                'required',
                'max:20',
                // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,15}$/'
            ]
        ];

        $mensajes = [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no debe exceder de 30 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.max' => 'Los apellidos no deben exceder de 30 caracteres.',
            'apellidos.regex' => 'Los apellidos solo pueden contener letras y espacios.',
            'tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'tipo_documento.in' => 'El tipo de documento seleccionado no es válido.',
            'identificacion.required' => 'El número de identificación es obligatorio.',
            'identificacion.max' => 'El número de identificación no debe exceder de 20 caracteres.',
            'identificacion.regex' => 'El número de identificación solo puede contener números.',
            'identificacion.unique' => 'Este número de identificación ya está registrado.',
            'id_genero.required' => 'El género es obligatorio.',
            'id_genero.integer' => 'El género debe ser un número entero.',
            'id_tipo.required' => 'El tipo de usuario es obligatorio.',
            'id_tipo.integer' => 'El tipo de usuario debe ser un número entero.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.max' => 'El correo electrónico no debe exceder de 255 caracteres.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'celular.required' => 'El número de celular es obligatorio.',
            'celular.max' => 'El número de celular no debe exceder de 15 caracteres.',
            'celular.regex' => 'El número de celular solo puede contener números.',
            'id_departamento.required' => 'El departamento es obligatorio.',
            'id_departamento.integer' => 'El departamento debe ser un número entero.',
            'id_municipio.required' => 'El municipio es obligatorio.',
            'id_municipio.integer' => 'El municipio debe ser un número entero.',
            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.max' => 'La dirección no debe exceder de 255 caracteres.',
            'id_cargo.required' => 'El cargo es obligatorio.',
            'id_cargo.integer' => 'El cargo debe ser un número entero.',
            'id_profesion.integer' => 'La profesión debe ser un número entero.',
            'id_maestria.integer' => 'La maestría debe ser un número entero.',
            'id_doctorado.integer' => 'El doctorado debe ser un número entero.',
            'Nombre_programa.max' => 'El nombre del programa no debe exceder de 255 caracteres.',
            'ficha.integer' => 'La ficha debe ser un número entero.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.regex' => 'La contraseña debe tener entre 8 y 15 caracteres, incluir al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.'
        ];

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes); //Validacion de los datos que se reciben

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422); //Enviamos los errores de validacion al Ajax
        } else {
            $count = User::where('identificacion', $datos['identificacion'])->get();
            if (count($count)) { //Verificamos si el usuario que se esta registrando ya existe en la base de datos
                return view('alertas.repetido'); //Se devuelve alerta al Ajax
            } else {
                $usuario = new User();
                $usuario->idRol = 0;
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
                $usuario->ficha = $request->filled('ficha') ? $request->ficha : null;
                $usuario->semillero_id = $request->semillero_id;
                $usuario->password = Hash::make($request->password);
                $usuario->estado_usu = in_array($request->id_cargo, ['3', '4', '22']) ? 1 : 0;

                $usuario->save();

                if ($request->has('semilleros')) {
                    foreach ($request->semilleros as $semillero) {
                        DB::table('semilleros_has_user')->insert([ //Se afilian los usuarios al semillero correspondiente
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

                return response()->json([ //Se devulevel al Ajax la tabla actualizada y el alerta correspondiente
                    'tabla' => $tabla,
                    'alerta' => $alerta
                ]);
            }
        }
    }

    public function getMunicipiosByDepartamento($departamento_id)
    {
        $municipios = Municipio::where(['departamento_id' => $departamento_id, 'estado_municipio' => 1])->get();
        return response()->json($municipios);
    }

    public function asignarRol(Request $request)
    {
        $reglas = [
            'idRol' => 'required',
            'documentos' => 'required',
            'estado_usu' => 'required'
        ];
        $mensajes = [
            'idRol.required' => 'Este campo es requerido',
            'documentos.required' => 'Seleccione al menos un usuario',
            'estado_usu.required' => 'El estado es requerido',
        ];
        $datos = $request->all();
        $rolAsignado = $datos['idRol'];
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            $respuestas['error'] = true;
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            foreach ($request->documentos as $documento) {
                $rolAsignado = new User();
                $rolAsignado->setIdRolAttribute($request->idRol);
                User::where('identificacion', $documento)->update($rolAsignado->toArray());
            }

            return view('alertas.modifcarExitoso');
        }
    }

    public function showAsignarRol(Request $request) //Muestra la vista con los usuarios sin verificar
    {
        $usuariosPendientes = User::orderBy('id', 'desc')->where('idRol', null)->paginate('5');

        $controladores = $request->controladores;
        $notificaciones = $request->notificaciones;
        return view('modals.usuarios.asignarRol', compact('usuariosPendientes', 'controladores', 'notificaciones'));
    }

    public function showModalAsignarRol(Request $request) //Muestra la modal para asiganar rol a los usuarios
    {
        $rolExistente = "SELECT * FROM roles WHERE estado_rol = 1";
        $idRol = $request->idRol;
        $usuarios = $request->documentos;
        $roles = DB::select($rolExistente);
        return view('modals.usuarios.modalAsignarRol', compact('roles', 'idRol', 'usuarios'));
    }

    public function showPerfil(Request $request) //Muestra el perfil con la informacion del usuario
    {
        $datos = $request->all();
        $generos = Genero::where('estado_genero', 1)->get();
        $tipo_poblaciones = Tipo_poblacion::where('estado_tp', 1)->get();
        $departamentos = Departamentos::where('estado_departamento', 1)->get();
        $municipios = Municipio::where('estado_municipio', 1)->get();
        $cargos = Cargos::where('estado_cargo', 1)->get();
        $profesiones = Profesiones::where('estado_profesion', 1)->get();
        $maestrias = Maestrias::where('estado_maestria', 1)->get();
        $doctorados = Doctorados::where('estado_doctorado', 1)->get();
        $controladores = $request->controladores;
        return view('modals.usuarios.perfil.verPerfil', compact('generos', 'tipo_poblaciones', 'departamentos', 'municipios', 'cargos', 'profesiones', 'maestrias', 'doctorados', 'controladores'));
    }

    public function actualizarPerfil(Request $request) //Proceso para actualizar la inforamcion de perfil(Usuario)
    {
        $reglas = [
            'name' => 'required|max:30',
            'apellidos' => 'required|max:30',
            'tipo_documento' => 'required|in:CC,TI,CE,Pasaporte,PEP,PPT',
            'identificacion' => 'required|max:20|unique:users,identificacion',
            'id_genero' => 'required|integer',
            'id_tipo_poblacion' => 'required|integer',
            'email' => 'required|email|max:255',
            'celular' => 'required|max:15',
            'id_departamento' => 'required|integer',
            'id_municipio' => 'required|integer',
            'direccion' => 'required'
        ];
        $mensajes = [
            'name.required' => 'Este campo es obligatorio',
            'name.max' => 'El campo debe contener máximo 30 caracteres',
            'apellidos.required' => 'Este campo es obligatorio',
            'apellidos.max' => 'El campo debe contener máximo 30 caracteres',
            'tipo_documento.required' => 'Este campo es obligatorio',
            'tipo_documento.in' => 'El tipo de documento no es válido',
            'identificacion.required' => 'Este campo es obligatorio',
            'identificacion.max' => 'El campo debe contener máximo 20 caracteres',
            'identificacion.unique' => 'Este número de identificación ya está registrado',
            'id_genero.required' => 'Este campo es obligatorio',
            'id_genero.integer' => 'El campo debe ser un número entero',
            'id_tipo_poblacion.required' => 'Este campo es obligatorio',
            'id_tipo_poblacion.integer' => 'El campo debe ser un número entero',
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
        ];

        $datos = $request->all();
        // dd($datos);
        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {

            User::where('id', Auth::user()->id)->update([
                'name' => $request->input('name'),
                'apellidos' => $request->input('apellidos'),
                'tipo_documento' => $request->input('tipo_documento'),
                'identificacion' => $request->input('identificacion'),
                'id_genero' => $request->input('id_genero'),
                'id_tipo' => $request->input('id_tipo_poblacion'),
                'email' => $request->input('email'),
                'celular' => $request->input('celular'),
                'id_cargo' => $request->input('id_cargo'),
                'id_municipio' => $request->input('id_municipio'),
                'id_departamento' => $request->input('id_departamento'),
                'direccion' => $request->input('direccion'),
            ]);
            $listaUsuarios = User::paginate('10');

            $alerta = view('alertas.actualizarExitoso');
            $tabla = view('modals.usuarios.tablaUsuarios', [
                'controladores' => $request->controladores,
                'listaUsuarios' => $listaUsuarios
            ]);

            return response()->json([
                'tabla' => $tabla,
                'alerta' => $alerta
            ]);
        }
    }

    public function showModalActualizar() //Modal para actualizar la informacion del usuario(Admin)
    {
        $roles = Rol::paginate('10');
        return view('modals.usuarios.actualizarUsuario', ['roles' => $roles]); //Se envia la modal al Ajax para ser mostrada
    }

    public function editarUsuario(Request $request) //Actualiza la informacion del usuario(Admin)
    {
        $datos = $request->all();

        $reglas = [
            'id_rol' => 'required',
            'password' => 'required',
            'estado_usu' => 'required'
        ];
        $mensajes = [
            'id_rol.required' => 'Este campo es obligatorio',
            'password.required' => 'Este campo es obligatorio',
            'estado_usu.required' => 'Esto campo es obligatorio'
        ];

        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = User::where([
                'identificacion' => $request->documento,
                'idRol' => $request->id_rol,
                'estado_usu' => $request->estado_usu
            ])
                ->where('id', '!=', Auth::user()->id)
                ->get();
            if (count($ajax)) {
                return view('alertas.repetido')->render();
            } else {
                $user = new User();
                $user->idRol = $request->id_rol;
                $user->password = Hash::make($request->password);
                $user->estado_usu = $request->estado_usu;

                // dd(User::where('identificacion', $request->documento)->get());
                // dd($user);                
                if (User::where('identificacion', $request->documento)->update($user->toArray())) {
                    $usuario = User::table;
                    $rol = Rol::table;
                    $listaUsuarios = DB::table($usuario)
                        ->join($rol, "$usuario.idRol", "=", "$rol.id_rol")
                        ->select('id', 'name', 'apellidos', 'tipo_documento', 'identificacion', 'email', 'estado_usu', 'rol')
                        ->paginate(10);
                    $controladores = $request->controladores;
                    // dd($listaUsuarios);
                    $tabla = view('modals.usuarios.tablaUsuarios', [
                        'controladores' => $controladores,
                        'listaUsuarios' => $listaUsuarios
                    ])->render();
                    // dd($tabla);
                    $alerta = view('alertas.modificarExitoso')->render();

                    return response()->json([
                        'alerta' => $alerta,
                        'tabla' => $tabla
                    ]);
                }
                return 'Error de actualizacion';
            }
        }
    }

    public function inhabilitarPerfil(Request $request)
    {
        $datos = $request->all();
        $reglas = [
            'documento' => 'required'
        ];
        $validacion = Validator::make($datos, $reglas);
        if ($validacion->fails()) {
            return response()->json(['errors', $validacion->errors()], 422);
        } else {
            User::where('identificacion', $request->validacion)->update('estado_usu', 0);
        }

        return view('alerta.usuarioInhabilidato')->render();
    }

    public function usersExport()
    {
        return Excel::download(new UsersExport, 'usuarios.xlsx');
    }
}
