<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as Validator;

class UsuarioController extends Controller
{

    public function showUsuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $lista = DB::select($sql);

        foreach ($lista as $elementos) {
            unset($elementos['id_usuario']);
            unset($elementos['updated_at']);
            unset($elementos['created_at']);
        }

        return view('usuario')->with($lista);
    }

    public function showRegistrarUsuarios()
    {
        return view('registrarUsuario');
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

        $respuestas = [];
        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;
            return redirect()->back()->withErrors($respuestas['validacion']);
            // dd($validacion->errors());
        } else {
            $respuestas['error'] = false;
            if (User::where('identificacion', $datos['documento'])) {
                return $mensaje = "El usuario ya está registrado";
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
                $usuario->setEstadoUsuAttribute(0);
                $usuario->setPasswordAttribute($contra);

                User::create($usuario->toArray());

                $listaCetros = User::paginate('10')->orderBy('id', 'desc');
                $controladores = $request->controladores;

                $tabla = view('modals.usuarios.tablaUsuario', [
                    'listaRedes' => $listaCetros,
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

    public function showActualizarUsuarios()
    {
        return view('actualizarUsuario');
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

        $respuestas = [];
        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            $respuestas['validacion'] = $validacion;
            $respuestas['error'] = true;

            return redirect()->back()->withErrors($respuestas['validacion']);
            // dd($validacion->errors());
        } else {
            if (User::where('identificacion', $datos['documento'])) {
                return $mensaje = false;
            } else {
                $respuestas['error'] = false;

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
                $usuario->setEstadoUsuAttribute(0);
                $usuario->setPasswordAttribute($contra);

                User::where('identificacion', $request->identificacion_old)->update($usuario->toArray());

                return view('alertas.modifcarExitoso')->render();
            }
        }
    }

    public function showAsignarRol($request)
    {
        $usuariosPendientes = User::where('id_rol', null)->get();
        foreach ($usuariosPendientes as $usuario) {
            unset($usuario['id_usuario']);
            unset($usuario['updated_at']);
            unset($usuario['created_at']);
        }

        return view('asignarRol')->with('usuariosPendientes', $usuariosPendientes);
    }

    public function asignarRol()
    {
        $datos = request()->all();
        $cedulaUsuario = $datos['identificacion'];
        $rolAsignado = $datos['rol'];

        User::where('identificacion', $cedulaUsuario)->update('id_rol', $rolAsignado);
    }
}
