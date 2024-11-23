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
            'funciones' => 'required'
        ];
    
        $mensajes = [
            'nombre_rol.required' => 'Este campo es obligatorio',
            'nombre_rol.max' => 'Este campo debe contener máximo 150 caracteres',
        ];
    
        $datos = $request->except('_token', 'controladores');
        $validacion = Validator::make($datos, $reglas, $mensajes);
    
        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        }
    
        $existe = Rol::where('rol', $datos['nombre_rol'])->exists();
    
        if ($existe) {
            $alerta = view('alertas.repetido')->render();
            return response()->json(['alerta' => $alerta]);
        }
    
        try {
            DB::beginTransaction();
    
            // Crear el rol
            $rol = Rol::create([
                'rol' => $request->nombre_rol,
                'estado_rol' => 1,
            ]);
    
            // Asignar permisos
            if ($request->has('funciones')) {
                foreach ($request->funciones as $funcion) {
                    Permiso::create([
                        'id_rol' => $rol->id_rol,
                        'id_funcion' => $funcion,
                        'estado_permiso' => 1
                    ]);
                }
            }
    
            // Renderizar tabla y alerta
            $controladores = $request->controladores;
            $listaRoles = Rol::orderBy('id_rol', 'desc')->paginate(10);
    
            $tabla = view('modals.rol.tablaRol', compact('controladores', 'listaRoles'))->render();
            $alerta = view('alertas.registrarExitoso')->render();
    
            DB::commit();
    
            return response()->json([
                'tabla' => $tabla,
                'alerta' => $alerta,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
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
    //     $alerta = view('alertas.registrarExitoso')->render();
    //     $tabla = view('modals.rol.tablaRol', compact('listaRoles'))->render();

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
        $reglas = [
            'nombre_rol' => 'required|max:30|regex:/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/',
            'estado_rol' => 'required|regex:/^[0-1]+$/',
        ];
        
        $mensajes = [
            'nombre_rol.required' => 'Este campo es obligatorio',
            'nombre_rol.max' => 'Este campo debe contener maximo 25 caracteres',
            'estado_rol.required' => 'Este campo es obligatorio'
        ];
        
        $datos = request()->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            try {
                DB::beginTransaction();

                $rol = new Rol();
                $rol->setRolAttribute($request->nombre_rol);
                $rol->setEstadoRolAttribute($request->estado_rol);

                if (Rol::where('rol', $datos['nombre_rol'])->update($rol->toArray())) {

                    $sql = log_auditoria::createLog(
                        'rol',
                        $rol->getRolAttribute(),
                        'actualizo',
                        $rol->nombre_rol
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
                } else {
                    $alerta = view('alertas.modificarError')->render();
                    return response()->json(['alerta' => $alerta]);
                }
            } catch (\Throwable $th) {
                dd($th);
                DB::rollBack();
                throw $th;
            }
        }
    }
}
