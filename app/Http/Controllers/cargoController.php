<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Log;
use App\Models\Rol;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class cargoController extends Controller
{
    public function showCargos(Request $request) //Muestra la vista con la lista de cargos disponibles
    {
        $cargos = Cargo::orderBy('estado_cargo', 'asc')->paginate(6);
        $controladores = $request->controladores;
        $notificaciones = $request->notificaciones;
        return view('modals.cargo.consultarCargos', compact('cargos', 'controladores', 'notificaciones'));
    }

    public function showModalRegistrar() //Muestra la modal para registrar un nuevo cargo
    {
        return view('modals.cargo.crearCargo');
    }


    public function registrarCargo(Request $request) //Proceso de registro del nuevo cargo
    {
        $reglas = [
            'nombre_cargo' => 'required|max:30|regex:/^[\pL\s]+$/u'
        ];

        $mensajes = [
            'nombre_cargo.required' => 'Este campo es obligatorio',
            'nombre_cargo.max' => 'Este campo debe contener maximo 30 caracteres',
            'nombre_cargo.regex' => 'Este campo solo puede contener letras'
        ];

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = Cargo::where('nombre_cargo', $datos['nombre_cargo'])->get();
            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
            } else {
                $cargo = new Cargo();

                $cargo->setNombreCargoAttribute($request->nombre_cargo);
                $cargo->setEstadoAttribute(1);

                if (Cargo::create($cargo->toArray())) {
                    $sql = log_auditoria::createLog(
                        'cargo',
                        $cargo->getNombreCargoAttribute(),
                        'registro'
                    );
                    Log::insert($sql);

                    $listaCargos = Cargo::orderBy('id_cargo', 'desc')->paginate('10');
                    $controladores = $request->controladores;

                    $tabla = view('modals.cargo.tablaCargo', [
                        'listaCargos' => $listaCargos,
                        'controladores' => $controladores
                    ])->render();
                    $alerta = view('alertas.registrarExitoso')->render();

                    return response()->json([
                        'tabla' => $tabla,
                        'alerta' => $alerta
                    ]);
                } else {
                    $alerta = view('alertas.registroError')->render();
                    return response()->json(['alerta' => $alerta]);
                }
            }
        }
    }

    public function showModalActualizar() //Muestra la modal para actualizar la informacion del cargo
    {
        return view('modals.cargo.modificarCargo');
    }

    public function actualizarCargo(Request $request) //Proceso de actualizacion de la informacion del cargo
    {
        $reglas = [
            'nombre_cargo' => 'required|max:30|regex:/^[\pL\s]+$/u',
            'estado_cargo' => 'required|gte:0|regex:/^[0-9]+$/'
        ];
        $mensajes = [
            'nombre_cargo.required' => 'Este campo es obligatorio',
            'nombre_cargo.max' => 'Este campo debe contener maximo 30 caracteres',
            'nombre_cargo.regex' => 'Este campo solo puede contener letras',
            'estado_cargo.required' => 'Este campo es obligatorio',
            'estado_cargo.gte' => 'Seleccione una de las opciones',
            'estado_cargo.regex' => 'Seleccione una opcion valida😡',
        ];

        $respuestas = [];
        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);
        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = Cargo::where([
                'nombre_cargo' => $datos['nombre_cargo'],
                'estado_cargo' => $datos['estado_cargo']
            ])->get();
            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
            } else {
                $cargo = new Cargo();

                $cargo->setNombreCargoAttribute($request->nombre_cargo);
                $cargo->setEstadoAttribute($request->estado_cargo);

                if (Cargo::where('nombre_cargo', $datos['nombre_cargo_old'])->update($cargo->toArray())) {
                    $sql = log_auditoria::createLog(
                        'cargo',
                        $datos['nombre_cargo_old'],
                        'actualizo',
                        $cargo->getNombreCargoAttribute()
                    );
                    Log::insert($sql);


                    $listaCargos = Cargo::orderBy('id_cargo', 'desc')->paginate('10');
                    $controladores = $request->controladores;

                    $alerta = view('alertas.actualizarExitoso')->render();
                    $tabla = view('modals.cargo.tablaCargo', [
                        'listaCargos' => $listaCargos,
                        'controladores' => $controladores
                    ])->render();

                    return response()->json([
                        'alerta' => $alerta,
                        'tabla' => $tabla
                    ]);
                } else {
                    $alerta = view('alertas.modificarError')->render();
                    return response()->json(['alerta' => $alerta]);
                }
            }
        }
    }
}
