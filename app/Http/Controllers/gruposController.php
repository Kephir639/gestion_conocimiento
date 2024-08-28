<?php

namespace App\Http\Controllers;

use App\Models\GrupoInvestigacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GruposController extends Controller
{
    public function showGrupos()
    {
        $sql = "SELECT nombre_grupo, estado_grupo FROM grupos_investigacion";
        $lista = GrupoInvestigacion::select($sql)->paginate('10');

        return view('gruposInvestigacion')->with($lista);
    }

    public function showRegistrarGrupos()
    {
        return view('registrarGrupos');
    }

    public function registrarGrupo(Request $request)
    {
        $reglas = [
            'nombre_grupo' => 'required|max:30',
            'estado_grupo' => 'required'
        ];
        $mensajes = [
            'nombre_grupo.required' => 'Este campo es obligatorio',
            'nombre_grupo.max' => 'Este campo debe contener maximo 30 caracteres',
            'estado_grupo.required' => 'Este campo es obligatorio'
        ];

        $validacion = Validator::make($request, $reglas, $mensajes);
        $respuestas = [];
        $datos = $request->all();

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;
            return redirect()->back()->withErrors($respuestas['mensaje']);
            // dd($validacion->errors());
        } else {
            $respuestas['error'] = false;
            if (GrupoInvestigacion::where('nombre_grupo', $datos['nombre_grupo'])) {
                return response()->json(['estado' => false], 200);
            } else {
                $grupo = new GrupoInvestigacion();

                $grupo->setNombreGrupoAttribute($request->nombre_grupo);
                $grupo->setEstadoGrupoAttribute($request->estado_grupo);

                GrupoInvestigacion::create($grupo);
                return response()->json(['estado' => true], 200);
            }
        }
    }

    public function actualizarGrupo(Request $request)
    {
        $reglas = [
            'nombre_grupo' => 'required|max:30',
            'estado_grupo' => 'required'
        ];
        $mensajes = [
            'nombre_grupo.required' => 'Este campo es obligatorio',
            'nombre_grupo.max' => 'Este campo debe contener maximo 30 caracteres',
            'estado_grupo.required' => 'Este campo es obligatorio'
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
            if (GrupoInvestigacion::where('nombre_grupo', $datos['nombre_grupo'])) {
                return 'Variable de JSON recibida por el Ajax para mostrar el alerta';
            } else {
                $grupo = new GrupoInvestigacion();

                $grupo->setNombreGrupoAttribute($request->nombre_grupo);
                $grupo->setEstadoGrupoAttribute($request->estado_grupo);

                GrupoInvestigacion::where('nombre_grupo', $datos['nombre_grupo_old'])->update($grupo);

                return response()->json(['estado' => true], 200);
            }
        }
    }
}
