<?php

namespace App\Http\Controllers;

use App\Models\CentrosFormacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class centroController extends Controller
{
    public function showCentros()
    {
        $lista = CentrosFormacion::paginate('10');
        $controladores = request()->controlador;

        return view('consultarCentroFormacion', compact('lista', 'controladores'));
    }

    public function showRegistrarCentros()
    {
        return view('registrarCentroFormacion');
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
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;

            //Se regresa a la ruta anterior con los errores cometidos para ser mostrados en la vista
            return redirect()->back()->withErrors($respuestas['mensaje']);
        } else {
            $respuestas['error'] = false;
            if (CentrosFormacion::where('nombre_centro', $datos['nombre_centro'])) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                return response()->json(['estado' => false], 200);
            } else {
                //Creamos un objeto
                $centro = new CentrosFormacion();
                //Le asignamos los valores del formulario
                $centro->setNombreCentroAttribute($request->nombre_centro);
                $centro->setCodigoCentroAttribute($request->codigo_centro);
                $centro->setEstadoCentroAttribute($request->estado_centro);
                //Registramos en la base de datos
                CentrosFormacion::create($centro);

                return response()->json(['estado' => true], 200);
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
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;
            return redirect()->back()->withErrors($respuestas['mensaje']);
        } else {
            $respuestas['error'] = false;
            if (CentrosFormacion::where('nombre_centro', $datos['nombre_centro'])) {
                return response()->json(['estado' => false], 200);
            } else {
                $centro = new CentrosFormacion();

                $centro->setNombreCentroAttribute($request->nombre_centro);
                $centro->setCodigoCentroAttribute($request->codigo_centro);
                $centro->setEstadoCentroAttribute($request->estado_centro);

                CentrosFormacion::where('id_centro', $datos['id_centro_old'])->update($centro);

                return response()->json(['estado' => true], 200);
            }
        }
    }
}
