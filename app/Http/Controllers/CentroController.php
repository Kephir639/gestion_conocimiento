<?php

namespace App\Http\Controllers;

use App\Models\CentrosFormacion;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class centroController extends Controller
{
    public function showCentros(Request $request)
    {
        $listaCentros = CentrosFormacion::orderBy('id_centro', 'desc')->paginate('3');
        $controladores = $request->controladores;
        $notificaciones = $request->notificaciones;
        return view('modals.centros.consultarCentros', compact('notificaciones', 'listaCentros', 'controladores'));
    }

    public function showModalRegistrar()
    {
        return view('modals.centros.crearCentros');
    }

    public function showModalActualizar()
    {
        return view('modals.centros.modificarCentros');
    }

    public function registrarCentro(Request $request)
    {
        $reglas = [
            'codigo_centro' => 'required|max:20',
            'nombre_centro' => 'required|max:30'
        ];
        $mensajes = [
            'codigo_centro.required' => 'Este campo es obligatorio',
            'codigo_centro.max' => 'Este campo debe contener maximo 30 caracteres',
            'nombre_centro.required' => 'Este campo es obligatorio',
            'nombre_centro.max' => 'Este campo debe contener maximo 30 caracteres'
        ];

        $respuestas = [];
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
                return view('alertas.repetido');
            } else {
                //Creamos un objeto
                $centro = new CentrosFormacion();
                //Le asignamos los valores del formulario
                $centro->setCodigoCentroAttribute($request->codigo_centro);
                $centro->setNombreCentroAttribute($request->nombre_centro);
                $centro->setEstadoCentroAttribute(1);
                //Registramos en la base de datos
                CentrosFormacion::create($centro->toArray());

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
            }
        }
    }

    public function actualizarCentro(Request $request)
    {
        $reglas = [
            'codigo_centro' => 'required|max:20',
            'nombre_centro' => 'required|max:30',
            'estado_centro' => 'required|gte:0'
        ];
        $mensajes = [
            'codigo_centro.required' => 'Este campo es obligatorio',
            'codigo_centro.max' => 'Este campo debe contener maximo 30 caracteres',
            'nombre_centro.required' => 'Este campo es obligatorio',
            'nombre_centro.max' => 'Este campo debe contener maximo 30 caracteres',
            'estado_centro.required' => 'Este campo es obligatorio',
            'estado_cargo.gte' => 'Seleccione una de las opciones'
        ];

        $respuestas = [];
        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            $respuestas['error'] = true;
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $respuestas['error'] = false;
            $ajax = CentrosFormacion::where([
                'nombre_centro' => $datos['nombre_centro'],
                'codigo_centro' => $datos['codigo_centro']
            ])->get();


            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                return view('alertas.repetido');
            } else {
                $centro = new CentrosFormacion();

                $centro->setNombreCentroAttribute($request->nombre_centro);
                $centro->setCodigoCentroAttribute($request->codigo_centro);
                $centro->setEstadoCentroAttribute($request->estado_centro);


                CentrosFormacion::where('nombre_centro', $datos['nombre_centro_old'])->update($centro->toArray());

                $sql = log_auditoria::createLog(
                    'centro',
                    $datos['nombre_centro_old'],
                    'actualizo',
                    $centro->getNombreCentroAttribute()
                );
                Log::insert($sql);

                return view('alertas.modifcarExitoso');
            }
        }
    }
}
