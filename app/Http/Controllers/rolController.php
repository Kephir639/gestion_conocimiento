<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Permiso;
use App\Models\Rol;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RolController extends Controller
{
    public function consultarRol(Request $request)
    {
        $listaRoles = Rol::orderBy('id_rol', 'desc')->paginate('5');
        $controladores = $request->controladores;
        $notificaciones = $request->notificaciones;
        return view('modals.rol.consultarRoles', compact('listaRoles', 'controladores', 'notificaciones'));
    }

    public function showModalRegistrar()
    {
        $funciones = $this->consultarFunciones();
        $array_existencia = array();

        $modal = view('modals.rol.crearRol', [
            'funciones' => $funciones,
            'array_existencia' => $array_existencia
        ])->render();

        return response()->json(['modal' => $modal]);
    }

    public function registrarRol(Request $request)
    {
        $datos = request()->all();

        $reglas = [
            'nombre_rol' => 'required|max:25',
            'estado_rol' => 'required',
        ];

        $mensajes = [
            'nombre_rol.required' => 'Este campo es obligatorio',
            'nombre_rol.max' => 'Este campo debe contener maximo 25 caracteres',
            'estado_rol.required' => 'Este campo es obligatorio'
        ];

        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            $respuestas['error'] = true;
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = Rol::where('rol', $request->nombre_rol)->get();

            if (count($ajax)) {
                return view('alertas.repetido')->render();
            } else {
                $rol = new Rol();

                $rol->setRolAttribute($request->nombre_rol);
                $rol->setEstadoRolAttribute(1);

                $registro = Rol::create($rol);

                $sql = log_auditoria::createLog(
                    'rol',
                    $rol->getRolAttribute(),
                    'registro'
                );
                Log::insert($sql);

                $idRol = $registro->id_rol;

                $funciones = $request->funciones;

                foreach ($funciones as $funcion) {
                    $resultado = Permiso::create([
                        'id_rol' => $idRol,
                        'id_funcion' => $funcion
                    ]);
                }

                if ($registro == true && $resultado == true) {
                    $controladores = $request->controladores;
                    $listaRoles = Rol::orderBy('id_rol', 'desc')->paginate('10');

                    $tabla = view('modals.roles.tablaRol', [
                        'controladores' => $controladores,
                        'listaRoles' => $listaRoles
                    ])->render();

                    $alerta = view('alertas.registrarExitoso')->render();

                    return response()->json([
                        'tabla' => $tabla,
                        'alerta' => $alerta
                    ]);
                } else {
                    //Alerta de error
                }
            }
        }
    }

    public function showModalActualizar(Request $request)
    {
        $permisos = $request->permisos;
        $idRol = Crypt::decrypt($request->id_rol);

        $permisoIds = array();
        foreach ($permisos as $permiso) {
            $permisoIds[] = $permiso->id_funcion;
        }

        $funciones = $this->consultarFunciones();
        $array_existencia = array();

        $modal = view('modals.rol.editarRol', [
            'permisos' => $permisos,
            'funciones' => $funciones,
            'array_existencia' => $array_existencia,
            'permisoIds' => $permisoIds
        ])->render();

        return response()->json(['modal' => $modal]);
    }


    public function actualizarRol(Request $request)
    {
        $datos = request()->all();

        $reglas = [
            'nombre_rol' => 'required|max:25',
            'estado_rol' => 'required',
        ];

        $mensajes = [
            'nombre_rol.required' => 'Este campo es obligatorio',
            'nombre_rol.max' => 'Este campo debe contener maximo 25 caracteres',
            'estado_rol.required' => 'Este campo es obligatorio'
        ];

        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = Rol::where('rol', $request->nombre_rol)->get();

            if (count($ajax)) {
                return view('alertas.repetido')->render();
            } else {
                $rol = new Rol();

                $rol->setRolAttribute($request->nombre_rol);
                $rol->setEstadoRolAttribute($request->estado_rol);

                Rol::where('rol', $request->nombre_rol)->update($rol->toArray());

                $sql = log_auditoria::createLog(
                    'rol',
                    $rol->getRolAttribute(),
                    'actualizo',
                    $request->nombre_rol_old
                );
                Log::insert($sql);

                $eliminados = $request->funciones_eliminadas;
                $agregados = $request->funciones_agregadas;

                foreach ($eliminados as $eliminado) {
                    Permiso::where('id_permiso', $eliminado)->update('estado_permiso', 0);
                }
                foreach ($agregados as $agregado) {
                    Permiso::where('id_permiso', $agregado)->update('estado_permiso', 1);
                }

                return view('alertas.modifcarExitoso');
            }
        }
    }

    public function consultarPermiso(Request $request)
    {
        $idRol = Rol::select('id')->where('rol', $request->nombre_rol)->get();
        $sql = "SELECT id_permiso, id_funcion FROM permisos WHERE id_rol = $idRol";

        $idRolCrypt = Crypt::encrypt($idRol);
        $permisos = DB::select($sql);

        return response()->json([
            'permisos' => $permisos,
            'id_rol' => $idRolCrypt
        ]);
    }

    public function consultarFunciones()
    {
        $sql = "SELECT fun.display_funcion nombre, fun.id_funcion id, con.id_controlador,
        con.displayController controlador FROM funciones fun, controladores con WHERE con.id_controlador = fun.id_controlador
        ORDER BY fun.id_controlador";

        $funciones = DB::select($sql);

        return $funciones;
    }
}
