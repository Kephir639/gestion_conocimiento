<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use  App\Models\ProyectoFormativo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProyectoFormativoController extends Controller
{

    #constantes del controlador

    # inicio consultas
    public function showProyectoFormativo(Request $request)
    {
        $controladores = $request->controladores;
        $notificaciones = $request->notificaciones;
        $listaProyectosFormativos = array();
        $compact = ['controladores', 'listaProyectosFormativos'];
        return view('modals.proyectos.formativo.consultarProyectoFormativo', compact($compact));
    }

    public function showModalRegistrar(Request $request)
    {
        $controladores = $request->controladores;
        $compact = ['controladores'];
        return view('modals.proyectos.formativo.crearProyectoFormativo', compact($compact));
    }

    public function showModalActualizar(Request $request)
    {
        $controladores = $request->controladores;
        $compact = ['controladores'];
        return view('modal.proyectos.formativo.actualizarProyectoFormativo', compact($compact));
    }

    # fin consultas

    # inicio peticiones
    public function registrarProyectoFormativo(Request $request)
    {
        $reglas = [
            'nombre_proyecto' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'objetivo_general' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'descripcion_problema' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'descripcion_actividad' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'experiencia_aprendiz' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'dificultad_solucion' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'leccion_aprendida' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'recomendaciones' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'concluciones' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/'
        ];
        $mensajes = [
            'nombre_proyecto.required' => 'Este campo es obligatorio',
            'nombre_proyecto.regex' => 'Este campo solo puede contener letras y numeros',
            'objetivo_general.required' => 'Este campo es obligatorio',
            'objetivo_general.regex' => 'Este campo solo puede contener letras y numeros',
            'descripcion_problema.required' => 'Este campo es obligatorio',
            'descripcion_problema.regex' => 'Este campo solo puede contener letras y numeros',
            'descripcion_actividad.required' => 'Este campo es obligatorio',
            'descripcion_actividad.regex' => 'Este campo solo puede contener letras y numeros',
            'experiencia_aprendiz.required' => 'Este campo es obligatorio',
            'experiencia_aprendiz.regex' => 'Este campo solo puede contener letras y numeros',
            'dificultad_solucion.required' => 'Este campo es obligatorio',
            'dificultad_solucion.regex' => 'Este campo solo puede contener letras y numeros',
            'leccion_aprendida.required' => 'Este campo es obligatorio',
            'leccion_aprendida.regex' => 'Este campo solo puede contener letras y numeros',
            'recomendaciones.required' => 'Este campo es obligatorio',
            'recomendaciones.regex' => 'Este campo solo puede contener letras y numeros',
            'concluciones.required' => 'Este campo es obligatorio',
            'concluciones.regex' => 'Este campo solo puede contener letras y numeros',
        ];

        $datos = $request->all();

        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = DB::table('proyectos_investigacion')
                ->where([
                    'nombre_proyecto' => $datos['nombre_proyecto'],
                    'objetivo_general' => $datos['objetivo_general'],
                    'descripcion_problema' => $datos['descripcion_problema'],
                    'descripcion_actividad' => $datos['descripcion_actividad'],
                    'experiencia_aprendiz' => $datos['experiencia_aprendiz'],
                    'dificultad_solucion' => $datos['dificultad_solucion'],
                    'leccion_aprendida' => $datos['leccion_aprendida'],
                    'recomendaciones' => $datos['recomendaciones'],
                    'concluciones' => $datos['concluciones']
                ])->get();

            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
            } else {
                $proyecto_formativo = new ProyectoFormativo();

                try {
                    DB::beginTransaction();

                    $proyecto_formativo->nombre_proyecto = $request->nombre_proyecto;
                    $proyecto_formativo->objetivo_general = $request->objetivo_general;
                    $proyecto_formativo->desctipcion_problema = $request->desctipcion_problema;
                    $proyecto_formativo->descripcion_actividad = $request->descripcion_actividad;
                    $proyecto_formativo->experiencia_aprendiz = $request->experiencia_aprendiz;
                    $proyecto_formativo->dificultad_solucion = $request->dificultad_solucion;
                    $proyecto_formativo->leccion_aprendida = $request->leccion_aprendida;
                    $proyecto_formativo->recomendaciones = $request->recomendaciones;
                    $proyecto_formativo->concluciones = $request->concluciones;
                    $proyecto_formativo->estado_proyecto_f = 1;

                    if ($proyecto = ProyectoFormativo::create($proyecto_formativo->toArray())) {
                        $sql = log_auditoria::createLog(
                            'proyecto_formativo',
                            $proyecto_formativo->nombre_proyecto,
                            'registro'
                        );
                        Log::insert($sql);

                        DB::commit();
                        $listaProyectos = ProyectoFormativo::orderBy('id_p_formativo', 'desc')->paginate('10');
                        $controladores = $request->controladores;
                        $tabla = view('modals.redes.tablaProyectos', [
                            'listaProyectos' => $listaProyectos,
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
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }
    }

    public function actualizarProyectoFormativo(Request $request)
    {
        $reglas = [
            'nombre_proyecto' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'objetivo_general' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'descripcion_problema' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'descripcion_actividad' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'experiencia_aprendiz' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'dificultad_solucion' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'leccion_aprendida' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'recomendaciones' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'concluciones' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'estado_proyecto_f' => 'required|regex:/^[0-1]+$/'
        ];
        $mensajes = [
            'nombre_proyecto.required' => 'Este campo es obligatorio',
            'nombre_proyecto.regex' => 'Este campo solo puede contener letras y numeros',
            'objetivo_general.required' => 'Este campo es obligatorio',
            'objetivo_general.regex' => 'Este campo solo puede contener letras y numeros',
            'descripcion_problema.required' => 'Este campo es obligatorio',
            'descripcion_problema.regex' => 'Este campo solo puede contener letras y numeros',
            'descripcion_actividad.required' => 'Este campo es obligatorio',
            'descripcion_actividad.regex' => 'Este campo solo puede contener letras y numeros',
            'experiencia_aprendiz.required' => 'Este campo es obligatorio',
            'experiencia_aprendiz.regex' => 'Este campo solo puede contener letras y numeros',
            'dificultad_solucion.required' => 'Este campo es obligatorio',
            'dificultad_solucion.regex' => 'Este campo solo puede contener letras y numeros',
            'leccion_aprendida.required' => 'Este campo es obligatorio',
            'leccion_aprendida.regex' => 'Este campo solo puede contener letras y numeros',
            'recomendaciones.required' => 'Este campo es obligatorio',
            'recomendaciones.regex' => 'Este campo solo puede contener letras y numeros',
            'concluciones.required' => 'Este campo es obligatorio',
            'concluciones.regex' => 'Este campo solo puede contener letras y numeros',
            'estado_proyecto_f.required' => 'Este campo es obligatorio',
            'estado_proyecto_f.regex' => 'Seleccione una opcion valida😡',
        ];

        $datos = $request->all();

        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = DB::table('proyectos_investigacion')
                ->where([
                    'nombre_proyecto' => $datos['nombre_proyecto'],
                    'objetivo_general' => $datos['objetivo_general'],
                    'descripcion_problema' => $datos['descripcion_problema'],
                    'descripcion_actividad' => $datos['descripcion_actividad'],
                    'experiencia_aprendiz' => $datos['experiencia_aprendiz'],
                    'dificultad_solucion' => $datos['dificultad_solucion'],
                    'leccion_aprendida' => $datos['leccion_aprendida'],
                    'recomendaciones' => $datos['recomendaciones'],
                    'concluciones' => $datos['concluciones']
                ])->get();

            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
            } else {
                $proyecto_formativo = new ProyectoFormativo();

                try {
                    DB::beginTransaction();

                    $proyecto_formativo->nombre_proyecto = $request->nombre_proyecto;
                    $proyecto_formativo->objetivo_general = $request->objetivo_general;
                    $proyecto_formativo->desctipcion_problema = $request->desctipcion_problema;
                    $proyecto_formativo->descripcion_actividad = $request->descripcion_actividad;
                    $proyecto_formativo->experiencia_aprendiz = $request->experiencia_aprendiz;
                    $proyecto_formativo->dificultad_solucion = $request->dificultad_solucion;
                    $proyecto_formativo->leccion_aprendida = $request->leccion_aprendida;
                    $proyecto_formativo->recomendaciones = $request->recomendaciones;
                    $proyecto_formativo->concluciones = $request->concluciones;
                    $proyecto_formativo->estado_proyecto_f = $request->estado_proyecto_f;

                    if ($proyecto = ProyectoFormativo::where([
                        'nombre_proyecto' => $request->nombre_proyecto_old,
                        'estado_proyecto_f' => $request->estado_proyecto_f
                    ])->update($proyecto_formativo->toArray())) {
                        $sql = log_auditoria::createLog(
                            'proyecto_formativo',
                            $datos['nombre_proyecto_old'],
                            'actualizo',
                            $proyecto_formativo->nombre_proyecto
                        );
                        Log::insert($sql);

                        DB::commit();
                        $listaProyectos = ProyectoFormativo::orderBy('id_p_formativo', 'desc')->paginate('10');
                        $controladores = $request->controladores;
                        $tabla = view('modals.redes.tablaProyectos', [
                            'listaProyectos' => $listaProyectos,
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
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }
    }
    # fin peticiones

    #funciones individuales

}
