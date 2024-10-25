<?php

namespace App\Http\Controllers;

use App\Models\GrupoInvestigacion;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class gruposController extends Controller
{
    public function showGrupos(Request $request) //Muestra la vista con la lista de grupos registrados
    {
        $listaGrupos = GrupoInvestigacion::orderBy('id_grupo', 'desc')->paginate('6');
        $controladores = $request->controladores;
        $notificaciones = $request->notificaciones;
        return view('modals.grupos.consultarGrupos', compact('listaGrupos', 'controladores', 'notificaciones'));
    }

    public function showModalRegistrar() //Muestra la modal de registrar grupo
    {
        return view('modals.grupos.crearGrupos');
    }

    public function registrarGrupo(Request $request) //Proceso de registro del grupo
    {
        $reglas = [
            'nombre_grupo' => 'required|max:30|regex:/^(?=.*[a-zA-ZñÑáéíóúÁÉÍÓÚ])(?=.*\d)[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]{15,}$/'
        ];
        $mensajes = [
            'nombre_grupo.required' => 'Este campo es obligatorio',
            'nombre_grupo.max' => 'Este campo debe contener maximo 30 caracteres',
            'nombre_grupo.regex' => 'Este campo debe tener minimo 15 letras y no permite caracteres especiales'
        ];

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            //Devolvemos los errrores de validacion al ajax
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = GrupoInvestigacion::where('nombre_grupo', $datos['nombre_grupo'])->get();
            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
            } else {
                $grupo = new GrupoInvestigacion();

                $grupo->setNombreGrupoAttribute($request->nombre_grupo);
                $grupo->setEstadoGrupoAttribute(1);

                if (GrupoInvestigacion::create($grupo->toArray())) {
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
                } else {
                    $alerta = view('alertas.registroError')->render();
                    return response()->json(['alerta' => $alerta]);
                }
            }
        }
    }

    public function showModalActualizar() //Muestra la modal de actualizar grupo
    {
        return view('modals.grupos.modificarGrupos');
    }

    public function actualizarGrupo(Request $request) //Proceso de actualizacion del grupo
    {
        $reglas = [
            'nombre_grupo' => 'required|max:30|regex:/^(?=.*[a-zA-ZñÑáéíóúÁÉÍÓÚ])(?=.*\d)[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]{15,}$/',
            'estado_grupo' => 'required|gte:0|regex:/^[0-9]+$/'
        ];
        $mensajes = [
            'nombre_grupo.required' => 'Este campo es obligatorio',
            'nombre_grupo.max' => 'Este campo debe contener maximo 30 caracteres',
            'nombre_grupo.regex' => 'Este campo debe tener minimo 15 letras y no permite caracteres especiales',
            'estado_grupo.required' => 'Este campo es obligatorio',
            'estado_grupo.gte' => '!!Seleccione una de las opciones¡¡',
            'estado_grupo.regex' => '!!Seleccione una opcion valida😡¡¡'

        ];

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            //Devolvemos los errores de validacion al ajax
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = GrupoInvestigacion::where([
                'nombre_grupo' => $datos['nombre_grupo'],
                'estado_grupo' => $datos['estado_grupo']
            ])->get();

            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
            } else {
                $grupo = new GrupoInvestigacion();

                $grupo->setNombreGrupoAttribute($request->nombre_grupo);
                $grupo->setEstadoGrupoAttribute($request->estado_grupo);

                if (GrupoInvestigacion::where('nombre_grupo', $datos['nombre_grupo_old'])->update($grupo->toArray())) {
                    $sql = log_auditoria::createLog(
                        'grupo',
                        $datos['nombre_grupo_old'],
                        'actualizo',
                        $grupo->getNombreGrupoAttribute()
                    );
                    Log::insert($sql);

                    $listaGrupos = GrupoInvestigacion::orderBy('id_grupo', 'desc')->paginate('10');
                    $controladores = $request->controladores;

                    $tabla = view('modals.grupos.tablaGrupo', [
                        'listaGrupos' => $listaGrupos,
                        'controladores' => $controladores
                    ])->render();
                    $alerta = view('alertas.modifcarExitoso')->render();

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
