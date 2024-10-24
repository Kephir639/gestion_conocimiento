<?php

namespace App\Http\Controllers;

use App\Models\CentrosFormacion;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class centroController extends Controller
{
    public function showCentros(Request $request) //Muestra la vista con la lista de centros registrados
    {
        $listaCentros = CentrosFormacion::orderBy('id_centro', 'desc')->paginate('6');
        $controladores = $request->controladores;
        $notificaciones = $request->notificaciones;
        return view('modals.centros.consultarCentros', compact('notificaciones', 'listaCentros', 'controladores'));
    }

    public function showModalRegistrar() // Muestra la modal para registrar un nuevo centro
    {
        return view('modals.centros.crearCentros');
    }

    public function registrarCentro(Request $request) //Proceso para el registro del centro
    {
        $reglas = [
            'codigo_centro' => 'required|max:20|regex:/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/',
            'nombre_centro' => 'required|max:50|regex:/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/'
        ];
        $mensajes = [
            'codigo_centro.required' => 'Este campo es obligatorio',
            'codigo_centro.max' => 'Este campo debe contener maximo 20 caracteres',
            'codigo_centro.regex' => 'Este campo solo puede contener letras y numeros',
            'nombre_centro.required' => 'Este campo es obligatorio',
            'nombre_centro.max' => 'Este campo debe contener maximo 50 caracteres',
            'nombre_centro.regex' => 'Este campo solo puede contener letras y numeros'
        ];

        $datos = $request->all();

        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            //Enviamos los errores de validacion al ajax
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = CentrosFormacion::where([
                'nombre_centro' => $datos['nombre_centro'],
                'codigo_centro' => $datos['codigo_centro']
            ])->get();

            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
            } else {
                //Creamos un objeto
                $centro = new CentrosFormacion();
                //Le asignamos los valores del formulario
                $centro->setCodigoCentroAttribute($request->codigo_centro);
                $centro->setNombreCentroAttribute($request->nombre_centro);
                $centro->setEstadoCentroAttribute(1);
                //Registramos en la base de datos
                if (CentrosFormacion::create($centro->toArray())) {
                    $sql = log_auditoria::createLog(
                        'centro',
                        $centro->getNombreCentroAttribute(),
                        'registro'
                    );
                    Log::insert($sql);

                    $listaCentros = CentrosFormacion::orderBy('id_centro', 'desc')->paginate('10');
                    $controladores = $request->controladores;
                    $tabla = view('modals.centros.tablaCentro', [
                        'listaCentros' => $listaCentros,
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

    public function showModalActualizar() //Muestra la modal para actualizar la informacion del centro
    {
        return view('modals.centros.modificarCentros');
    }

    public function actualizarCentro(Request $request) //Proceso para actualizar la informacion del centro
    {
        $reglas = [
            'codigo_centro' => 'required|max:20|regex:/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/',
            'nombre_centro' => 'required|max:50|regex:/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/',
            'estado_centro' => 'required|gte:0|regex:/^[0-9]+$/'
        ];
        $mensajes = [
            'codigo_centro.required' => 'Este campo es obligatorio',
            'codigo_centro.max' => 'Este campo debe contener maximo 20 caracteres',
            'codigo_centro.regex' => 'Este campo solo puede contener letras y numeros',
            'nombre_centro.required' => 'Este campo es obligatorio',
            'nombre_centro.max' => 'Este campo debe contener maximo 50 caracteres',
            'nombre_centro.regex' => 'Este campo solo puede contener letras y numeros',
            'estado_centro.required' => 'Este campo es obligatorio',
            'estado_centro.gte' => 'Seleccione una de las opciones',
            'estado_centro.regex' => 'Seleccione una opcion valida😡',

        ];
        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = CentrosFormacion::where([
                'nombre_centro' => $datos['nombre_centro'],
                'codigo_centro' => $datos['codigo_centro']
            ])->get();

            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
            } else {
                $centro = new CentrosFormacion();

                $centro->setNombreCentroAttribute($request->nombre_centro);
                $centro->setCodigoCentroAttribute($request->codigo_centro);
                $centro->setEstadoCentroAttribute($request->estado_centro);

                if (CentrosFormacion::where('nombre_centro', $datos['nombre_centro_old'])->update($centro->toArray())) {
                    $sql = log_auditoria::createLog(
                        'centro',
                        $datos['nombre_centro_old'],
                        'actualizo',
                        $centro->getNombreCentroAttribute()
                    );
                    Log::insert($sql);

                    $listaCentros = CentrosFormacion::orderBy('id_centro', 'desc')->paginate('10');
                    $controladores = $request->controladores;

                    $tabla = view('modals.centros.tablaCentro', [
                        'listaCentros' => $listaCentros,
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
