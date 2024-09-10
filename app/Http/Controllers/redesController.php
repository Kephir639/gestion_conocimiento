<?php

namespace App\Http\Controllers;

use App\Models\Redes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RedesController extends Controller
{

    public function showRedes(Request $request)
    {
        $listaRedes = Redes::orderBy('id_red', 'desc')->paginate('10');
        $controladores = $request->controladores;

        return view('modals.redes.consultarRedes', compact('listaRedes', 'controladores'));
    }

    public function showModalRegistrar()
    {
        return view('modals.redes.crearRedes');
    }

    public function registrarRed(Request $request)
    {
        $reglas = [
            'nombre_red' => 'required|max:30',
        ];
        $mensajes = [
            'nombre_red.required' => 'Este campo es obligatorio',
            'nombre_red.max' => 'Este campo debe contener maximo 30 caracteres',
        ];

        $datos = $request->all();
        $respuestas = [];
        $validacion = Validator::make($datos, $reglas, $mensajes);


        // dd($datos['nombre_red']);
        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;
            return response()->json(['errors' => $validacion->errors()], 422);
            // dd($validacion->errors());
        } else {
            $respuestas['error'] = false;
            $ajax = Redes::where('nombre_red', $datos['nombre_red'])->get();
            if (count($ajax)) {
                return view('alertas.repetido');
            } else {
                $red = new Redes();

                $red->setNombreRedAttribute($request->nombre_red);
                $red->setEstadoRedAttribute(1);

                Redes::create($red->toArray());

                $listaRedes = Redes::paginate('10')->orderBy('id_red', 'desc');
                $controladores = $request->controladores;

                $tabla = view('modals.redes.tablaRed', [
                    'listaRedes' => $listaRedes,
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

    public function showModalModificar()
    {
        return view('modals.redes.modificarRedes');
    }

    public function actualizarRed(Request $request)
    {
        $reglas = [
            'nombre_red' => 'required|max:30',
            'estado_red' => 'required|gt:0'
        ];
        $mensajes = [
            'nombre_red.required' => 'Este campo es obligatorio',
            'nombre_red.max' => 'Este campo debe contener maximo 30 caracteres',
            'estado_red.required' => 'Este campo es obligatorio',
            'estado_red.gt' => 'Elija una de las opciones'
        ];

        $respuestas = [];
        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            // dump('falla');
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;
            return response()->json(['errors' => $validacion->errors()], 422);
            // dd($validacion->errors());
        } else {
            $respuestas['error'] = false;
            $ajax = Redes::where('nombre_red', $datos['nombre_red'])->get();
            if (count($ajax)) {
                return view('alertas.repetido')->with(['controladores' => $request->controladores]);
            } else {
                $red = new Redes();

                $red->setNombreRedAttribute($request->nombre_red);
                $red->setEstadoRedAttribute($request->estado_red);

                Redes::where('nombre_red', $datos['nombre_red_old'])->update($red->toArray());

                return view('alertas.modifcarExitoso');
            }
        }
    }
}
