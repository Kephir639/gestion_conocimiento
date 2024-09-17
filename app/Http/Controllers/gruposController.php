<?php

namespace App\Http\Controllers;

use App\Models\GrupoInvestigacion;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class gruposController extends Controller
{
    public function showGrupos(Request $request)
    {
        $listaGrupos = GrupoInvestigacion::orderBy('id_grupo', 'desc')->paginate('10');
        $controladores = $request->controladores;
        $notificaciones = $request->notificaciones;
        return view('modals.grupos.consultarGrupos', compact('listaGrupos', 'controladores', 'notificaciones'));
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

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = GrupoInvestigacion::where('nombre_grupo', $datos['nombre_grupo'])->get();

            if (count($ajax)) {
                return view('alertas.repetido')->render();
            } else {
                $grupo = new GrupoInvestigacion();

                $grupo->setNombreGrupoAttribute($request->nombre_grupo);
                $grupo->setEstadoGrupoAttribute(1);

                GrupoInvestigacion::create($grupo->toArray());

                $sql = log_auditoria::createLog(
                    'grupo',
                    $grupo->getNombreGrupoAttribute(),
                    'registro'
                );
                Log::insert($sql);

                $listaGrupos = GrupoInvestigacion::orderBy('id_grupo', 'desc')->paginate('10');
                $controladores = $request->controladores;

                $tabla = view('modals.grupos.tablaGrupo', [
                    'listaGrupos' => $listaGrupos,
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

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = GrupoInvestigacion::where('nombre_grupo', $datos['nombre_grupo'])->get();

            if (count($ajax)) {
                return view('alertas.repetido')->render();
            } else {
                $grupo = new GrupoInvestigacion();

                $grupo->setNombreGrupoAttribute($request->nombre_grupo);
                $grupo->setEstadoGrupoAttribute($request->estado_grupo);

                GrupoInvestigacion::where('nombre_grupo', $datos['nombre_grupo_old'])->update($grupo);

                $sql = log_auditoria::createLog(
                    'grupo',
                    $datos['nombre_grupo_old'],
                    'actualizo',
                    $grupo->getNombreGrupoAttribute()
                );
                Log::insert($sql);

                return view('alertas.modifcarExitoso')->render();
            }
        }
    }
}
