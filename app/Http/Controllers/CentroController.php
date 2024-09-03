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
        $listaCentros = CentrosFormacion::paginate('10')->orderBy('id_centro', 'desc');
        $controladores = $request->controladores;

        return view('consultarCentroFormacion', compact('listaCentros'));
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
            'nombre_centro' => 'required|max:30',
            'estado_centro' => 'required'
        ];
        $mensajes = [
            'codigo_centro.required' => 'Este campo es obligatorio',
            'codigo_centro.max' => 'Este campo debe contener maximo 30 caracteres',
            'nombre_centro.required' => 'Este campo es obligatorio',
            'nombre_centro.max' => 'Este campo debe contener maximo 30 caracteres',
            'estado_centro.required' => 'Este campo es obligatorio'
        ];

        $respuestas = [];
        $datos = $request->all();

        //Se realiza la validacion de los campos
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            $respuestas['error'] = true;

            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $respuestas['error'] = false;
            $ajax = CentrosFormacion::where('nombre_centro', $datos['nombre_centro'])->get();

            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                return view('alertas.repetido');
            } else {
                //Creamos un objeto
                $centro = new CentrosFormacion();
                //Le asignamos los valores del formulario
                $centro->setCodigoCentroAttribute($request->codigo_centro);
                $centro->setNombreCentroAttribute($request->nombre_centro);
                $centro->setEstadoCentroAttribute($request->estado_centro);
                //Registramos en la base de datos
                CentrosFormacion::create($centro);

                $sql = log_auditoria::createLog(
                    'centro',
                    $centro->getNombreCentroAttribute(),
                    'registro'
                );
                Log::insert($sql);

                $listaCetros = CentrosFormacion::paginate('10')->orderBy('id_centro', 'desc');
                $controladores = $request->controladores;

                $tabla = view('modals.centros.tablaCentro', [
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

    public function actualizarCentro(Request $request)
    {
        $reglas = [
            'codigo_centro' => 'required|max:20',
            'nombre_centro' => 'required|max:30',
            'estado_centro' => 'required'
        ];
        $mensajes = [
            'codigo_centro.required' => 'Este campo es obligatorio',
            'codigo_centro.max' => 'Este campo debe contener maximo 30 caracteres',
            'nombre_centro.required' => 'Este campo es obligatorio',
            'nombre_centro.max' => 'Este campo debe contener maximo 30 caracteres',
            'estado_centro.required' => 'Este campo es obligatorio'
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
            $ajax = CentrosFormacion::where('nombre_centro', $datos['nombre_centro'])->get();

            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                return view('alertas.repetido');
            } else {
                $centro = new CentrosFormacion();

                $centro->setNombreCentroAttribute($request->nombre_centro);
                $centro->setCodigoCentroAttribute($request->codigo_centro);
                $centro->setEstadoCentroAttribute($request->estado_centro);

                CentrosFormacion::where('id_centro', $datos['nombre_centro_old'])->update($centro);

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
