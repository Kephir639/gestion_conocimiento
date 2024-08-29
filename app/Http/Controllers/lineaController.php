<?php

namespace App\Http\Controllers;

use App\Models\LineaInvestigacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class lineaController extends Controller
{
    public function showLineas()
    {
        $sql = "SELECT nombre_linea, estado FROM lineas_investigacion";

        $lista = LineaInvestigacion::select($sql)->paginate('10');
        return view('lineas')->with($lista);
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
        $respuestas = [];
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;
            //Se regresa a la ruta anterior con los errores cometidos para ser mostrados en la vista
            return redirect()->back()->withErrors($respuestas['mensaje']);
        } else {
            $respuestas['error'] = false;
            if (LineaInvestigacion::where('nombre_linea', $datos['inputNombreLinea'])->exists()) {
                return response()->json(['estado' => false, 'mensaje' => 'El linea ya existe'], 200);
            } else {
                $linea = new LineaInvestigacion();

                $linea->setNombreCargoAttribute($request->nombre_linea);
                $linea->setEstadoAttribute($request->estado_linea);

                LineaInvestigacion::create($linea);

                $listaLinea = LineaInvestigacion::paginate('10')->orderBy('id_linea', 'desc');
                $controladores = $request->controladores;

                $tabla = view('modals.lineas.tablaLineas', ['listaLineas' => $listaLinea, 'controladores' => $controladores])->render();
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

        $respuestas = [];
        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);
        if ($validacion->fails()) {
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;
            return redirect()->back()->withErrors($respuestas['mensaje']);
            // dd($validacion->errors());
        } else {
            $respuestas['error'] = false;
            $ajax = LineaInvestigacion::where('nombre_linea', $datos['nombre_linea'])->get();

            if (count($ajax)) {
                return view('alertas.repetido');
            } else {
                $linea = new LineaInvestigacion();

                $linea->setNombreLineaAttribute($request->nombre_linea);
                $linea->setEstadoAttribute($request->estado_linea);

                LineaInvestigacion::where('nombre_linea', $datos['nombre_linea_old'])->update($linea);

                return view('alertas.modifcarExitoso');
            }
        }
    }
}
