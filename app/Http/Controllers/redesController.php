<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Redes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RedesController extends Controller
{

    public function showRedes(Request $request) //Muestra la vista con la lista de redes registradas
    {
        $listaRedes = Redes::orderBy('id_red', 'desc')->paginate('6');
        $controladores = $request->controladores;
        $usuariosPendientes = $request->usuariosPendientes;
        $notificaciones = $request->notificaciones;
        // dd($request);
        return view('modals.redes.consultarRedes', compact('listaRedes', 'controladores', 'usuariosPendientes', 'notificaciones'));
    }

    public function showModalRegistrar() //Muestra la modal de registro
    {
        return view('modals.redes.crearRedes');
    }

    public function registrarRed(Request $request) //Proceso para registrar una nueva red de investigacion
    {
        $reglas = [
            'nombre_red' => 'required|max:30|regex:/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/',
        ];
        $mensajes = [
            'nombre_red.required' => 'Este campo es obligatorio',
            'nombre_red.max' => 'Este campo debe contener maximo 30 caracteres',
            'nombre_red.regex' => 'Este campo solo puede contener letras y numeros'
        ];

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
            // dd($validacion->errors());
        } else {
            $ajax = Redes::where('nombre_red', $datos['nombre_red'])->get();
            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
            } else {
                try {
                    DB::beginTransaction();
                    $red = new Redes();
                    $red->setNombreRedAttribute($request->nombre_red);
                    $red->setEstadoRedAttribute(1);

                    if (Redes::create($red->toArray())) {
                        $sql = log_auditoria::createLog(
                            'red',
                            $red->getNombreRedAttribute(),
                            'registro'
                        );
                        Log::insert($sql);

                        $listaRedes = Redes::orderBy('id_red', 'desc')->paginate('10');
                        $controladores = $request->controladores;

                        $tabla = view('modals.redes.tablaRed', [
                            'listaRedes' => $listaRedes,
                            'controladores' => $controladores
                        ])->render();

                        $alerta = view('alertas.registrarExitoso')->render();
                        DB::commit();
                        return response()->json([
                            'tabla' => $tabla,
                            'alerta' => $alerta
                        ]);
                    } else {
                        $alerta = view('alertas.registroError')->render();
                        return response()->json(['alerta' => $alerta]);
                    }
                } catch (\Throwable $th) {
                    DB::rollBack();
                    throw $th;
                }
            }
        }
    }

    public function showModalActualizar() //Muestra la modal para acutalizar las redes de investgacion
    {
        return view('modals.redes.modificarRedes');
    }

    public function actualizarRed(Request $request) //Proceso de actualizacion de la red
    {
        $reglas = [
            'nombre_red' => 'required|max:30|regex:/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/',
            'estado_red' => 'required|regex:/^[0-1]+$/'
        ];
        $mensajes = [
            'nombre_red.required' => 'Este campo es obligatorio',
            'nombre_red.max' => 'Este campo debe contener maximo 30 caracteres',
            'nombre_red.regex' => 'Este campo solo puede contener letras y numeros',
            'estado_red.required' => 'Este campo es obligatorio',
            'estado_red.regex' => 'Seleccione una opcion valida😡'
        ];
        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = Redes::where(['nombre_red' => $datos['nombre_red'], 'estado_red' => $datos['estado_red']])->get();
            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
            } else {
                try {
                    DB::beginTransaction();
                    $red = new Redes();
                    $red->setNombreRedAttribute($request->nombre_red);
                    $red->setEstadoRedAttribute($request->estado_red);

                    if (Redes::where('nombre_red', $datos['nombre_red_old'])->update($red->toArray())) {
                        $sql = log_auditoria::createLog(
                            'red',
                            $datos['nombre_red_old'],
                            'actualizo',
                            $red->getNombreRedAttribute()
                        );
                        Log::insert($sql);

                        $listaRedes = Redes::orderBy('id_red', 'desc')->paginate('10');
                        $controladores = $request->controladores;

                        $tabla = view('modals.redes.tablaRed', [
                            'listaRedes' => $listaRedes,
                            'controladores' => $controladores
                        ])->render();
                        $alerta = view('alertas.actualizarExitoso')->render();
                        DB::commit();
                        return response()->json([
                            'tabla' => $tabla,
                            'alerta' => $alerta
                        ]);
                    } else {
                        $alerta = view('alertas.modificarError')->render();
                        return response()->json(['alerta' => $alerta]);
                    }
                } catch (\Throwable $th) {
                    DB::rollBack();
                    throw $th;
                }
            }
        }
    }
}
