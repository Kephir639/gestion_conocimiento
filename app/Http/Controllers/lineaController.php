<?php

namespace App\Http\Controllers;

use App\Models\LineaInvestigacion;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class lineaController extends Controller
{
    public function showLineas(Request $request)
    {
        $listaLineas = LineaInvestigacion::orderBy('id_linea', 'desc')->paginate('5');
        $controladores = $request->controladores;
        $notificaciones = $request->notificaciones;
        return view('modals.lineas.consultarLinea', compact('listaLineas', 'controladores', 'notificaciones'));
    }

    public function showModalRegistrar()
    {
        return view('modals.cargo.crearCargo');
    }

    public function registrarLinea(Request $request)
    {
        $reglas = [
            'nombre_linea' => 'required',
            'estado_linea' => 'required'
        ];

        $mensajes = [
            'nombre_linea.required' => 'Este campo es obligatorio',
            'nombre_linea.max' => 'Este campo debe contener maximo 30 caracteres',
            'estado_linea.required' => 'Este campo es obligatorio'
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
                return view('alertas.repetido')->render();
            } else {
                $linea = new LineaInvestigacion();

                $linea->setNombreLineaAttribute($request->nombre_linea);
                $linea->setEstadoAttribute(1);

                LineaInvestigacion::create($linea->toArray);

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
            }
        }
    }

    public function showModalActualizar()
    {
        return view('modals.cargo.modificarCargo');
    }

    public function actualizarLinea(Request $request)
    {
        $reglas = [
            'nombre_linea' => 'required|max:30',
            'estado_linea' => 'required'
        ];
        $mensajes = [
            'nombre_linea.required' => 'Este campo es obligatorio',
            'nombre_linea.max' => 'Este campo debe contener maximo 30 caracteres',
            'estado_linea.required' => 'Este campo es obligatorio'
        ];

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = LineaInvestigacion::where('nombre_linea', $datos['nombre_linea'])->get();

            if (count($ajax)) {
                return view('alertas.repetido')->render();
            } else {
                $linea = new LineaInvestigacion();

                $linea->setNombreLineaAttribute($request->nombre_linea);
                $linea->setEstadoAttribute($request->estado_linea);

                LineaInvestigacion::where('nombre_linea', $datos['nombre_linea_old'])
                    ->update($linea->toArray());

                $sql = log_auditoria::createLog(
                    'linea',
                    $datos['nombre_linea_old'],
                    'actualizo',
                    $linea->getNombreLineaAttribute()
                );
                Log::insert($sql);

                return view('alertas.modifcarExitoso')->render();
            }
        }
    }
}
