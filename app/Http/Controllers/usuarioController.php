<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as Validator;

class usuarioController extends Controller
{

    public function showUsuarios(Request $request)
    {
        $listaUsuarios = User::orderBy('id', 'desc')->paginate('10');
        $controladores = $request->controladores;

        return view('modals.usuario.consultarUsuario', [
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
            'id_rol' => 'required',
            'nombres' => 'required|max:30',
            'apellidos' => 'required|max:30',
            'tipoDocumento' => 'required|gt:0',
            'identificacion' => 'required|max:11',
            'id_genero' => 'required|max:15|gt:0',
            'id_tipo_poblacion' => 'required|max:15|gt:0',
            'correo' => 'required|email|max:25',
            'celular' => 'required|max:15',
            'departamento' => 'required|gt:0',
            'id_municipio' => 'required|gt:0',
            'direccion' => 'required',
            'profesion' => 'required',
            'maestria' => 'required',
            'doctorado' => 'required',
            'id_cargo' => 'required',
            'id_programa' => 'required',
            'semillero' => 'required',
            'contraseña' => 'required|regex:^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$^',
        ];

        $mensajes = [
            'nombres.required' => 'Este campo es obligatorio',
            'nombres.max' => 'El campo debe contener maximo 30 caracteres',
            'apellidos.required' => 'Este campo es obligatorio',
            'apellidos.max' => 'El campo debe contener maximo 30 caracteres',
            'tipoDocumento.required' => 'Este campo es obligatorio',
            'tipoDocumento.max' => 'El campo debe de contener maximo 15 caracteres',
            'identificacion.required' => 'Este campo es obligatorio',
            'identificacion.max' => 'El campo debe contener maximo 11 caracteres',
            'id_genero.required' => 'Este campo es obligatorio',
            'id_genero.max' => 'El campo debe de contener maximo 15 caracteres',
            'id_tipo_poblacion.required' => 'Este campo es obligatorio',
            'id_tipo_poblacion.max' => 'El campo debe de contener maximo 15 caracteres',
            'correo.required' => 'Este campo es obligatorio',
            'correo.email' => 'Esta no es una direccion de correo electronico valida',
            'correo.max' => 'Este campo debe contener maximo 25 caracteres',
            'celular.required' => 'Este campo es obligatorio',
            'celular.max' => 'El campo debe de contener maximo 15 caracteres',
            'departamento.required' => 'Este campo es obligatorio',
            'id_municipio.required' => 'Este campo es obligatorio',
            'direccion.required' => 'Este campo es obligatorio',
            'profesion.required' => 'Este campo es obligatorio',
            'maestria.required' => 'Este campo es obligatorio',
            'doctorado.required' => 'Este campo es obligatorio',
            'id_cargo.required' => 'Este campo es obligatorio',
            'id_programa.required' => 'Este campo es obligatorio',
            'semillero.required' => 'Este campo es obligatorio',
            'contraseña.required' => 'Este campo es obligatorio',
            'contraseña.regex' => 'La contraseña debe contener minimo 8 y maximo 15 caracteres:
                                   * 1 Minuscula
                                   * 1 Mayuscula
                                   * 1 Numero Entero
                                   * 1 Caracter Especial'
        ];

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = User::where('identificacion', $datos['documento'])->get();
            if (count($ajax)) {
                return view('alertas.repetido')->render();
            } else {
                $usuario = new User();

                $contra = Hash::make($request->contraseña);
                $cargo = $request->cargo;

                $usuario->setNameAttribute($request->nombres);
                ($cargo == 'Aprendiz') ? ($usuario->setIdRolAttribute(2)) : (($cargo == 'Dinamizador SENNOVA') ? ($usuario->setIdRolAttribute(7)) : (($cargo == 'Auditor') ? ($usuario->setIdRolAttribute(9)) : null));
                $usuario->setIdRolAttribute(null);
                $usuario->setApellidoAttribute($request->apellidos);
                $usuario->setIdentificacionAttribute($request->identificacion);
                $usuario->setIdGeneroAttribute($request->genero);
                $usuario->setIdTipoPoblacionAttribute($request->tipoPoblacion);
                $usuario->setEmailAttribute($request->correo);
                $usuario->setCelularAttribute($request->celular);
                $usuario->setIdMunicipioAttribute($request->municipio);
                $usuario->setDireccionAttribute($request->direccion);
                $usuario->setIdCargoAttribute($request->cargo);
                $usuario->setIdProgramaAttribute($request->programa);
                ($cargo == 'Aprendiz' || $cargo == 'Dinamizador SENNOVA' || $cargo == 'Auditor') ? ($usuario->setEstadoUsuAttribute(1)) : ($usuario->setEstadoUsuAttribute(0));
                $usuario->setPasswordAttribute($contra);

                $registro = User::create($usuario->toArray());

                foreach ($request->semilleros as $semillero) {
                    $sql = "INSERT INTO semilleros_has_user (id, id_semillero) VALUES ('" . $registro->id . "','" . $semillero . "')";
                    DB::insert($sql);
                }

                $listausuarios = User::orderBy('id', 'desc')->paginate('10');
                $controladores = $request->controladores;

                $tabla = view('modals.usuarios.tablaUsuario', [
                    'listaRedes' => $listausuarios,
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

    public function actualizarUsuario(Request $request)
    {

        $reglas = [
            'id_rol' => 'required',
            'nombres' => 'required|max:30',
            'apellidos' => 'required|max:30',
            'tipoDocumento' => 'required|gt:0',
            'identificacion' => 'required|max:11',
            'id_genero' => 'required|gt:0',
            'id_tipo_poblacion' => 'required|gt:0',
            'correo' => 'required|email|max:25',
            'celular' => 'required|max:15',
            'departamento' => 'required',
            'id_municipio' => 'required',
            'direccion' => 'required',
            'profesion' => 'required',
            'maestria' => 'required',
            'doctorado' => 'required',
            'id_cargo' => 'required',
            'id_programa' => 'required',
            'semillero' => 'required',
            'contraseña' => 'required|regex:^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$^',
        ];

        $mensajes = [
            'nombres.required' => 'Este campo es obligatorio',
            'nombres.max' => 'El campo debe contener maximo 30 caracteres',
            'apellidos.required' => 'Este campo es obligatorio',
            'apellidos.max' => 'El campo debe contener maximo 30 caracteres',
            'tipoDocumento.required' => 'Este campo es obligatorio',
            'tipoDocumento.max' => 'El campo debe de contener maximo 15 caracteres',
            'identificacion.required' => 'Este campo es obligatorio',
            'identificacion.max' => 'El campo debe contener maximo 11 caracteres',
            'id_genero.required' => 'Este campo es obligatorio',
            'id_genero.max' => 'El campo debe de contener maximo 15 caracteres',
            'id_tipo_poblacion.required' => 'Este campo es obligatorio',
            'id_tipo_poblacion.max' => 'El campo debe de contener maximo 15 caracteres',
            'correo.required' => 'Este campo es obligatorio',
            'correo.email' => 'Esta no es una direccion de correo electronico valida',
            'correo.max' => 'Este campo debe contener maximo 25 caracteres',
            'celular.required' => 'Este campo es obligatorio',
            'celular.max' => 'El campo debe de contener maximo 15 caracteres',
            'departamento.required' => 'Este campo es obligatorio',
            'id_municipio.required' => 'Este campo es obligatorio',
            'direccion.required' => 'Este campo es obligatorio',
            'profesion.required' => 'Este campo es obligatorio',
            'maestria.required' => 'Este campo es obligatorio',
            'doctorado.required' => 'Este campo es obligatorio',
            'id_cargo.required' => 'Este campo es obligatorio',
            'id_programa.required' => 'Este campo es obligatorio',
            'semillero.required' => 'Este campo es obligatorio',
            'contraseña.required' => 'Este campo es obligatorio',
            'contraseña.regex' => 'La contraseña debe contener minimo 8 y maximo 15 caracteres:
                                    1 Minuscula
                                    1 Mayuscula
                                    1 Numero Entero
                                    1 Caracter Especial'
        ];

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = User::where('identificacion', $datos['documento'])->get();
            if (count($ajax)) {
                return view('alertas.repetido')->render();
            } else {
                $usuario = new User();

                $contra = Hash::make($request->contraseña);

                $usuario->setNameAttribute($request->nombres);
                $usuario->setApellidoAttribute($request->apellidos);
                $usuario->setIdentificacionAttribute($request->identificacion);
                $usuario->setIdGeneroAttribute($request->genero);
                $usuario->setIdTipoPoblacionAttribute($request->tipoPoblacion);
                $usuario->setEmailAttribute($request->correo);
                $usuario->setCelularAttribute($request->celular);
                $usuario->setIdMunicipioAttribute($request->municipio);
                $usuario->setDireccionAttribute($request->direccion);
                $usuario->setIdCargoAttribute($request->cargo);
                $usuario->setIdProgramaAttribute($request->programa);
                $usuario->setPasswordAttribute($contra);

                User::where('identificacion', $request->identificacion_old)->update($usuario->toArray());

                return view('alertas.modifcarExitoso')->render();
            }
        }
    }

    public function showAsignarRol(Request $request)
    {
        $usuariosPendientes = User::where('id_rol', null)->get();
        $controladores = $request->controladores;

        return view('asignarRol', [
            'usuariosPendientes' => $usuariosPendientes,
            'controladores' => $controladores
        ]);
    }

    public function asignarRol(Request $request)
    {
        $datos = $request->all();
        $cedulaUsuario = $datos['identificacion'];
        $rolAsignado = $datos['rol'];

        User::where('identificacion', $cedulaUsuario)
            ->update(['id_rol' => $rolAsignado, 'estado_usu' => 1]);
    }
}
