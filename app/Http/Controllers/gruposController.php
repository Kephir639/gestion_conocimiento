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
        $listaGrupos = GrupoInvestigacion::paginate('10')->orderBy('id_grupo', 'desc');

        return view('modals.grupos.consultarGrupos', compact('listaGrupos'));
    }

    public function showModalRegistrar()
    {
        return view('modals.grupos.crearGrupos');
    }

    public function showModalActualizar()
    {
        return view('modals.grupos.modificarGrupos');
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
        } else {
            $respuestas['error'] = false;
            $ajax = GrupoInvestigacion::where('nombre_grupo', $datos['nombre_grupo'])->get();

            if (count($ajax)) {
                return view('alertas.repetido');
            } else {
                $grupo = new GrupoInvestigacion();

                $grupo->setNombreGrupoAttribute($request->nombre_grupo);
                $grupo->setEstadoGrupoAttribute($request->estado_grupo);

                GrupoInvestigacion::create($grupo);

                $listaGrupos = GrupoInvestigacion::paginate('10')->orderBy('id_grupo', 'desc');
                $controladores = $request->controladores;

                $tabla = view('modals.grupos.tablaGrupo', ['listaGrupos' => $listaGrupos, 'controladores' => $controladores])->render();
                $alerta = view('alertas.registrarExitoso')->render();

                return response()->json([
                    'tabla' => $tabla,
                    'alerta' => $alerta
                ]);
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
            $ajax = GrupoInvestigacion::where('nombre_grupo', $datos['nombre_grupo'])->get();

            if (count($ajax)) {
                return view('alertas.repetido');
            } else {
                $grupo = new GrupoInvestigacion();

                $grupo->setNombreGrupoAttribute($request->nombre_grupo);
                $grupo->setEstadoGrupoAttribute($request->estado_grupo);

                GrupoInvestigacion::where('nombre_grupo', $datos['nombre_grupo_old'])->update($grupo);

                return view('alertas.modifcarExitoso');
            }
        }
    }
}
