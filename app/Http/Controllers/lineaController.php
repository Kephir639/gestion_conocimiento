<?php

namespace App\Http\Controllers;

use App\Models\LineaInvestigacion;
use App\Models\Log;
use App\Models\Semilleros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class lineaController extends Controller
{
    public function showLineas(Request $request) //Muestra la vista con la lista de lineas de investigacion
    {
        $controladores = request()->controladores;
        $listaLineas = LineaInvestigacion::orderBy('id_linea', 'desc')->paginate('6');

        return view('modals.lineas.consultarLinea', [
            'listaLineas' => $listaLineas,
            'controladores' => $controladores
        ]);
    }

    public function showModalRegistrar() //Muestra la modal de registro
    {
        return view('modals.lineas.crearLinea');
    }

    public function registrarLinea(Request $request) //Proceso de registro de la linea de investigacion
    {
        $reglas = [
            'nombre_linea' => 'required|max:30|regex:/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/'
        ];

        $mensajes = [
            'nombre_linea.required' => 'Este campo es obligatorio',
            'nombre_linea.max' => 'Este campo debe contener maximo 30 caracteres',
            'nombre_linea.regex' => 'Este campo solo puede contener letras y numeros'
        ];

        $datos = $request->all();

        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            //Se regresa a la ruta anterior con los errores cometidos para ser mostrados en la vista
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {

            $ajax = LineaInvestigacion::where('nombre_linea', $datos['inputNombreLinea'])->get();
            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
            } else {
                $linea = new LineaInvestigacion();

                $linea->setNombreLineaAttribute($request->nombre_linea);
                $linea->setEstadoAttribute(1);

                if (LineaInvestigacion::create($linea->toArray())) {
                    $sql = log_auditoria::createLog(
                        'linea',
                        $linea->getNombreLineaAttribute(),
                        'registro'
                    );
                    Log::insert($sql);

                    $listaLinea = LineaInvestigacion::orderBy('id_linea', 'desc')->paginate('10');
                    $controladores = $request->controladores;

                    $tabla = view('modals.lineas.tablaLineas', [
                        'listaLineas' => $listaLinea,
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

    public function showModalActualizar() //Muestra la modal de actualizar
    {
        return view('modals.lineas.modificarLinea');
    }

    public function actualizarLinea(Request $request) //Proceso de actualizacion de lineas de investigacion
    {
        $reglas = [
            'nombre_linea' => 'required|max:30|regex:/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/',
            'estado_linea' => 'required|gte:0|lte:1|regex:/^[0-9]+$/'
        ];
        $mensajes = [
            'nombre_linea.required' => 'Este campo es obligatorio',
            'nombre_linea.max' => 'Este campo debe contener maximo 30 caracteres',
            'nombre_linea.regex' => 'Este campo solo puede contener letras y numeros',
            'estado_linea.required' => 'Este campo es obligatorio',
            'estado_linea.gte' => 'Seleccione una opcion valida😡',
            'estado_linea.lte' => 'Seleccione una opcion valida😡',
            'estado_linea.regex' => 'Seleccione una opcion valida😡'

        ];

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = LineaInvestigacion::where([
                'nombre_linea' => $datos['nombre_linea'],
                'estado_linea' => $datos['estado_linea']
            ])->get();

            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
            } else {
                $linea = new LineaInvestigacion();

                $linea->setNombreLineaAttribute($request->nombre_linea);
                $linea->setEstadoAttribute($request->estado_linea);

                if (LineaInvestigacion::where('nombre_linea', $datos['nombre_linea_old'])
                    ->update($linea->toArray())
                ) {
                    $sql = log_auditoria::createLog(
                        'linea',
                        $datos['nombre_linea_old'],
                        'actualizo',
                        $linea->getNombreLineaAttribute()
                    );
                    Log::insert($sql);

                    $listaLineas = LineaInvestigacion::orderBy('id_linea', 'desc')->paginate('10');
                    $controladores = $request->controladores;

                    $tabla = view('modals.lineas.tablaLinea', [
                        'listaLineas' => $listaLineas,
                        'controladores' => $controladores
                    ])->render();
                    $alerta = view('alertas.actualizarExitoso')->render();

                    return response()->json([
                        'tabla' => $tabla,
                        'alerta' => $alerta
                    ]);
                } else {
                    $alerta = view('alertas.modificarError')->render();
                    return response()->json(['alerta' => $alerta]);
                }
            }
        }
    }
}
