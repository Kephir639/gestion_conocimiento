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

        $reglas = [
            'nombre_rol' => 'required|max:150',
        ];

        $mensajes = [
            'nombre_rol.required' => 'Este campo es obligatorio',
            'nombre_rol.max' => 'Este campo debe contener maximo 30 caracteres'
        ];

        $datos = request()->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = Rol::where('rol', $datos['nombre_rol'])->get();

            if (count($ajax)) {
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
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

                    $tabla = view('modals.rol.tablaRol', [
                        'controladores' => $controladores,
                        'listaRoles' => $listaRoles
                    ])->render();

                    $alerta = view('alertas.registrarExitoso')->render();

                    return response()->json([
                        'tabla' => $tabla,
                        'alerta' => $alerta
                    ]);
                } else {
                    return 'Error';
                }
            }
        }
    }
    // public function registrarRol(Request $request)
    // {
    //     $reglas = [
    //         'nombre_rol' => 'required|max:150',
    //         'funciones' => 'required'
    //     ];

    //     $mensajes = [
    //         'nombre_rol.required' => 'Este campo es obligatorio',
    //         'nombre_rol.max' => 'Este campo debe contener máximo 150 caracteres',
    //     ];

    //     $datos = $request->all();

    //     $validacion = Validator::make($datos, $reglas, $mensajes);

    //     if ($validacion->fails()) {
    //         return response()->json(['errors' => $validacion->errors()], 422);
    //     }

    //     if (Rol::where('rol', $request->nombre_rol)->exists()) {
    //         $alerta = view('alertas.repetido')->render();
    //         return response()->json(['alerta' => $alerta]);
    //     }

    //     // Crear el rol
    //     $rol = Rol::create([
    //         'rol' => $request->nombre_rol,
    //         'estado' => 1, // Estado por defecto
    //     ]);

    //     // Asignar funciones al rol
    //     if ($request->has('funciones')) {
    //         foreach ($request->funciones as $funcion) {
    //             Permiso::create([
    //                 'id_rol' => $rol->id_rol,
    //                 'id_funcion' => $funcion,
    //             ]);
    //         }
    //     }

    //     // Retornar respuesta con tabla y alerta
    //     $listaRoles = Rol::orderBy('id_rol', 'desc')->paginate(10);
    //     $tabla = view('modals.rol.tablaRol', compact('listaRoles'))->render();
    //     $alerta = view('alertas.registrarExitoso')->render();

    //     return response()->json([
    //         'tabla' => $tabla,
    //         'alerta' => $alerta,
    //     ]);
    // }


    public function consultarPermiso(Request $request)
    {
        $idRol = Rol::select('id_rol')->where('rol', $request->nombre_rol)->get();
        $permisos = DB::table('permisos')->select('id_permiso', 'id_funcion')
            ->where('id_rol', $idRol->first()->id_rol)->get();

        return response()->json([
            'permisos' => $permisos
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

    public function showModalActualizar(Request $request)
    {
        $permisos = $request->permisos;

        $permisoIds = array();
        foreach ($permisos as $permiso) {
            $permisoIds[] = $permiso['id_funcion'];
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


            $rol = new Rol();

            $rol->setRolAttribute($request->nombre_rol);
            $rol->setEstadoRolAttribute($request->estado_rol);

            Rol::where('rol', $request->nombre_rol_old)->update($rol->toArray());

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
                if (isset($eliminados)) {
                    DB::table('permisos')->where('id_permiso', $eliminado['id'])->update(['estado_permiso' => 0]);
                }
            }
            foreach ($agregados as $agregado) {
                if (isset($agregados)) {

                    Permiso::where('id_permiso', $agregado)->update(['estado_permiso' => 1]);
                }
            }

            return view('alertas.actualizarExitoso');
        }
    }
}
