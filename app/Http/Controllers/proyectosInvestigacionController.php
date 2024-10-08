<?php

namespace App\Http\Controllers;

use App\Models\CentrosFormacion;
use App\Models\GrupoInvestigacion;
use App\Models\LineaInvestigacion;
use App\Models\Log;
use App\Models\Programas;
use App\Models\proyectosInvestigacion;
use App\Models\Redes;
use App\Models\Semilleros;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Array_;

class proyectosInvestigacionController extends Controller
{

    public function showProyectosInvestigativos(Request $request)
    {
        $listaProyectos = proyectosInvestigacion::orderBy('id_p_investigacion', 'desc')->paginate('10');
        $controladores = $request->controladores;

        return view('modals.proyectos.investigacion.consultarProyectos', [
            'listaProyectos' => $listaProyectos,
            'controladores' => $controladores
        ]);
    }

    public function showModalRegistrar(Request $request)
    {
        $centros = CentrosFormacion::all();
        $grupos = GrupoInvestigacion::all();
        $lineas = LineaInvestigacion::all();
        $redes = Redes::all();
        $programas = Programas::all();
        $semilleros = Semilleros::all();
        $participantes = User::all();

        // dd($centros, $grupos, $lineas, $programas, $semilleros, $participantes);
        return view('modals.proyectos.investigacion.crearProyectos', [
            'centros' => $centros,
            'grupos' => $grupos,
            'lineas' => $lineas,
            'programas' => $programas,
            'semilleros' => $semilleros,
            'participantes' => $participantes,
            'redes' => $redes
        ]);
    }

    public function agregarActividad(Request $request)
    {
        $contador_actividad = $request->contador_actividad;

        return view('modals.proyectos.investigacion.div.divActividad', [
            'contador_actividad' => $contador_actividad
        ])->render();
    }

    public function agregarPresupuesto(Request $request)
    {
        $contador_presupuesto = $request->contador_presupuesto;

        return view('modals.proyectos.investigacion.div.divPresupuesto', [
            'contador_presupuesto' => $contador_presupuesto
        ])->render();
    }

    public function showModalActualizar(Request $request)
    {
        return view('modals.proyectos.investigacion.modificarProyectos');
    }

    public function registrarProyectoInvestigacion(Request $request)
    {
        // dd($request->all());

        $reglas = [
            'ano_ejecucion' => 'required',
            'codigo_sigp' => 'required',
            'nombre_proyecto' => 'required',
            'centros' => 'required',
            'grupos' => 'required',
            'lineas' => 'required',
            'redes' => 'required',
            'programas' => 'required',
            'semilleros' => 'required',
            'participantes' => 'required',
            'resumen' => 'required',
            'objetivo_general' => 'required',
            'objetivos_especificos' => 'required',
            'propuesta' => 'required',
            'impacto_esperado' => 'required',
            'actividades' => 'required',
            'presupuestos' => 'required'
        ];
        $mensajes = [
            'ano_ejecucion.required' => 'Este campo es obligatorio',
            'codigo_sigp.required' => 'Este campo es obligatorio',
            'nombre_proyecto.required' => 'Este campo es obligatorio',
            'centros.required' => 'Este campo es obligatorio',
            'grupos.required' => 'Este campo es obligatorio',
            'lineas.required' => 'Este campo es obligatorio',
            'redes.required' => 'Este campo es obligatorio',
            'programas.required' => 'Este campo es obligatorio',
            'semilleros.required' => 'Este campo es obligatorio',
            'participantes.required' => 'Este campo es obligatorio',
            'resumen.required' => 'Este campo es obligatorio',
            'objetivo_general.required' => 'Este campo es obligatorio',
            'objetivos_especificos.required' => 'Este campo es obligatorio',
            'propuesta.required' => 'Este campo es obligatorio',
            'impacto_esperado.required' => 'Este campo es obligatorio',
            'actividades.required' => 'Este campo es obligatorio',
            'presupuestos.required' => 'Este campo es obligatorio'
        ];

        $datos = $request->all();

        unset($datos['controladores']);
        // dd($datos);

        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = DB::table('proyectos_investigacion')->where('codigo_sigp', $datos['codigo_sigp'])->get();
            if (count($ajax)) {
                return view('alertas.repetido');
            } else {
                $proyecto_investigacion = new proyectosInvestigacion();

                try {
                    DB::beginTransaction();

                    $proyecto_investigacion->ano_ejecucion = $request->ano_ejecucion;
                    $proyecto_investigacion->codigo_sigp = $request->codigo_sigp;
                    $proyecto_investigacion->nombre_proyecto = $request->nombre_proyecto;
                    $proyecto_investigacion->resumen_proyecto = $request->resumen;
                    $proyecto_investigacion->objetivo_general = $request->objetivo_general;
                    $proyecto_investigacion->propuesta = $request->propuesta;
                    $proyecto_investigacion->impacto = $request->impacto_esperado;
                    $proyecto_investigacion->estado_p_investigacion = 1;

                    $proyecto = proyectosInvestigacion::create($proyecto_investigacion->toArray());

                    // dd($proyecto);
                    $actividades = $proyecto_investigacion->crearArray($datos, 'actividades');
                    $entregables = $proyecto_investigacion->crearArray($datos, 'entregables');
                    $observaciones = $proyecto_investigacion->crearArray($datos, 'observaciones');
                    $descripciones = $proyecto_investigacion->crearArray($datos, 'descripciones');
                    $enlaces = $proyecto_investigacion->crearArray($datos, 'enlaces');
                    $cumplidos = $proyecto_investigacion->crearArray($datos, 'cumplidos');
                    $conceptos = $proyecto_investigacion->crearArray($datos, 'conceptos');
                    $rubros = $proyecto_investigacion->crearArray($datos, 'rubros');
                    $uso_presupuestal = $proyecto_investigacion->crearArray($datos, 'uso_presupuestal');
                    $valores = $proyecto_investigacion->crearArray($datos, 'valores');

                    //Registrar centros asociados al proyecto de investigacion
                    foreach ($request->centros as $centro) {
                        DB::table('investigacion_has_centros')->insert([
                            'id_p_investigacion' => $proyecto->id,
                            'id_centro' => $centro,
                            'estado_ihc' => 1
                        ]);
                    }
                    //Registrar grupos asociados al proyecto de investigacion
                    foreach ($request->grupos as $grupo) {
                        DB::table('investigacion_has_grupos')->insert([
                            'id_p_investigacion' => $proyecto->id,
                            'id_grupo' => $grupo,
                            'estado_ihg' => 1
                        ]);
                    }
                    //Registrar lineas asociadas al proyecto de investigacion
                    foreach ($request->lineas as $linea) {
                        DB::table('investigacion_has_lineas')->insert([
                            'id_p_investigacion' => $proyecto->id,
                            'id_linea' => $linea,
                            'estado_ihl' => 1
                        ]);
                    }
                    //Registrar redes asociados al proyecto de investigacion
                    foreach ($request->redes as $red) {
                        DB::table('investigacion_has_redes')->insert([
                            'id_p_investigacion' => $proyecto->id,
                            'id_red' => $red,
                            'estado_ihr' => 1
                        ]);
                    }
                    //Registrar programas asociados al proyecto de investigacion
                    foreach ($request->programas as $programa) {
                        DB::table('investigacion_has_programas')->insert([
                            'id_p_investigacion' => $proyecto->id,
                            'id_programa' => $programa,
                            'estado_ihp' => 1
                        ]);
                    }
                    //Registrar semilleros asociados al proyecto de investigacion
                    foreach ($request->semilleros as $semillero) {
                        DB::table('investigacion_has_semilleros')->insert([
                            'id_p_investigacion' => $proyecto->id,
                            'id_semillero' => $semillero,
                            'estado_ihs' => 1
                        ]);
                    }
                    //Registrar participantes asociados al proyecto de investigacion
                    foreach ($request->participantes as $participantes) {
                        DB::table('investigacion_has_users')->insert([
                            'id_p_investigacion' => $proyecto->id,
                            'id' => $participantes,
                            'estado_ihu' => 1
                        ]);
                    }
                    //Registrar objetivos especificos asociados al proyecto de investigacion
                    foreach ($request->objetivos_especificos as $objetivo_especifico) {
                        DB::table('investigacion_objetivos')->insert([
                            'id_p_investigacion' => $proyecto->id,
                            'objetivo_especifico' => $objetivo_especifico,
                            'estado_objetivo_i' => 1
                        ]);
                    }

                    //Registrar actividades asociadas al proyecto de investigacion
                    for ($i = 0; $i < count($descripciones); $i++) {
                        $actividad = DB::table('investigacion_actividades_unificada')->insert([
                            'id_p_investigacion' => $proyecto->id,
                            'descripcion' => $descripciones['descripciones'][$i],
                            'enlace_evidencia' => $enlaces['enlaces'][$i],
                            'cumplido' => $cumplidos['cumplidos'][$i],
                            'estado_actividad_u_i' => 1
                        ]);
                        $id_actividad_i = DB::getPdo()->lastInsertId();
                        foreach ($actividades as $key => $arrayActividad) {
                            foreach ($arrayActividad as $actividad => $act) {
                                DB::table('investigacion_actividades')->insert([
                                    'id_actividad_i' => $id_actividad_i,
                                    'actividad' => $act[$i],
                                    'estado_actividad_i' => 1
                                ]);
                            }
                        }
                        foreach ($entregables as $key => $arrayEntregables) {
                            foreach ($arrayEntregables as $entregable => $entrg) {
                                DB::table('investigacion_entregables')->insert([
                                    'id_actividad_i' => $id_actividad_i,
                                    'entregable' => $entrg[$i],
                                    'estado_entregable_i' => 1
                                ]);
                            }
                        }
                        foreach ($observaciones as $key => $arrayobservaciones) {
                            foreach ($arrayobservaciones as $observacion => $obs) {
                                DB::table('investigacion_observaciones')->insert([
                                    'id_actividad_i' => $id_actividad_i,
                                    'observacion' => $obs[$i],
                                    'estado_observacion_i' => 1
                                ]);
                            }
                        }
                    }
                    //Presupuestos
                    for ($i = 0; $i < count($conceptos); $i++) {
                        $presupuesto = DB::table('investigacion_presupuestos')->create([
                            'id_p_investigacion' => $proyecto->id_p_investigacion,
                            'concepto' => $conceptos[$i],
                            'rubro' => $rubros[$i],
                            'uso_presupuestal' => $uso_presupuestal[$i],
                            'estado_presupuesto_i' => 1
                        ]);
                        $id_presupuesto_i = DB::getPdo()->lastInsertId();
                        foreach ($valores as $valor) {
                            DB::table('investigacion_presupuestos_valores')->insert([
                                'id_presupuesto_i' => $id_presupuesto_i,
                                'valor' => $valor,
                                'estado_valor_i' => 1
                            ]);
                        }
                    }
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollBack();

                    dd($th);
                }


                $sql = log_auditoria::createLog(
                    'proyecto_investigacion',
                    $proyecto_investigacion->nombre_proyecto,
                    'registro'
                );
                Log::insert($sql);
                $listaProyectos = proyectosInvestigacion::orderBy('id_p_investigacion', 'desc')->paginate('10');
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
            }
        }
    }


    public function actualizarProyectoInvestigacion(Request $request)
    {
        $reglas = [
            'ano_ejecucion' => 'required',
            'codigo_sigp' => 'required',
            'nombre_proyecto' => 'required',
            'centros' => 'required',
            'grupos' => 'required',
            'lineas' => 'required',
            'redes' => 'required',
            'programas' => 'required',
            'semilleros' => 'required',
            'participantes' => 'required',
            'resumen' => 'required',
            'objetivo_general' => 'required',
            'objetivos_especificos' => 'required',
            'propuesta' => 'required',
            'impacto_esperado' => 'required',
            'descripcion' => 'required',
            'actividades' => 'required',
            'entregables' => 'required',
            'enlace_evidencia' => 'required',
            'cumplido' => 'required',
            'observaciones' => 'required',
            'concepto' => 'required',
            'rubro' => 'required',
            'uso_presupuestal' => 'required',
            'valor_planteado' => 'required'

        ];
        $mensajes = [
            'ano_ejecucion.required' => 'Este campo es obligatorio',
            'codigo_sigp.required' => 'Este campo es obligatorio',
            'nombre_proyecto.required' => 'Este campo es obligatorio',
            'centros.required' => 'Este campo es obligatorio',
            'grupos.required' => 'Este campo es obligatorio',
            'lineas.required' => 'Este campo es obligatorio',
            'redes.required' => 'Este campo es obligatorio',
            'programas.required' => 'Este campo es obligatorio',
            'semilleros.required' => 'Este campo es obligatorio',
            'participantes.required' => 'Este campo es obligatorio',
            'resumen.required' => 'Este campo es obligatorio',
            'objetivo_general.required' => 'Este campo es obligatorio',
            'objetivos_especificos.required' => 'Este campo es obligatorio',
            'propuesta.required' => 'Este campo es obligatorio',
            'impacto_esperado.required' => 'Este campo es obligatorio',
            'descripcion.required' => 'Este campo es obligatorio',
            'actividades.required' => 'Este campo es obligatorio',
            'entregables.required' => 'Este campo es obligatorio',
            'enlace_evidencia.required' => 'Este campo es obligatorio',
            'cumplido.required' => 'Este campo es obligatorio',
            'observaciones.required' => 'Este campo es obligatorio',
            'rubro.required' => 'Este campo es obligatorio',
            'uso_presupuestal.required' => 'Este campo es obligatorio',
            'valor_planteado.required' => 'Este campo es obligatorio'
        ];
        $datos = $request->all();

        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = DB::table('proyectos_investigacion')
                ->where('codigo_sigp', $datos['codigo_sigp_old'])->get();

            if (count($ajax)) {
                return view('alertas.repetido')->render();
            } else {
                $proyecto_investigacion = new proyectosInvestigacion();

                $proyecto_investigacion->ano_ejecucion = $request->ano_ejecucion;
                $proyecto_investigacion->codigo_sigp = $request->codigo_sigp;
                $proyecto_investigacion->nombre_proyecto = $request->nombre_proyecto;
                $proyecto_investigacion->resumen_proyecto = $request->resumen_proyecto;
                $proyecto_investigacion->objetivo_general = $request->objetivo_general;
                $proyecto_investigacion->propuesta = $request->propuesta;
                $proyecto_investigacion->impacto = $request->impacto;

                $proyecto = proyectosInvestigacion::where('codigo_sigp', $request->codigo_sigp_old)
                    ->update($proyecto_investigacion->toArray());

                //Centros
                $proyecto_investigacion->actualizarElementos(
                    $request->codigo_sigp_old,
                    'investigacion_has_centros',
                    $request->centros,
                    'id_p_investigacion',
                    'id_centro',
                    'estado_ihc'
                );
                //Grupos
                $proyecto_investigacion->actualizarElementos(
                    $request->codigo_sigp_old,
                    'investigacion_has_grupos',
                    $request->grupos,
                    'id_p_investigacion',
                    'id_grupo',
                    'estado_ihg'
                );
                //Lineas
                $proyecto_investigacion->actualizarElementos(
                    $request->codigo_sigp_old,
                    'investigacion_has_lineas',
                    $request->lineas,
                    'id_p_investigacion',
                    'id_linea',
                    'estado_ihl'
                );
                //Redes
                $proyecto_investigacion->actualizarElementos(
                    $request->codigo_sigp_old,
                    'investigacion_has_redes',
                    $request->redes,
                    'id_p_investigacion',
                    'id_red',
                    'estado_ihr'
                );
                //Programas
                $proyecto_investigacion->actualizarElementos(
                    $request->codigo_sigp_old,
                    'investigacion_has_programas',
                    $request->programas,
                    'id_p_investigacion',
                    'id_programa',
                    'estado_ihp'
                );
                //Semilleros
                $proyecto_investigacion->actualizarElementos(
                    $request->codigo_sigp_old,
                    'investigacion_has_semilleros',
                    $request->semilleros,
                    'id_p_investigacion',
                    'id_semillero',
                    'estado_ihs'
                );
                //Participantes
                $proyecto_investigacion->actualizarElementos(
                    $request->codigo_sigp_old,
                    'investigacion_has_users',
                    $request->grupos,
                    'id_p_investigacion',
                    'id',
                    'estado_ihu'
                );
                //Objetivos Especificos
                $proyecto_investigacion->actualizarElementos(
                    $request->codigo_sigp_old,
                    'investigacion_has_objetivos',
                    $request->objetivos_especificos,
                    'id_p_investigacion',
                    'id_objetivo',
                    'estado_objetivo_i'
                );
                //Actividades


            }
        }
    }
    public function seguimientoProyecto(Request $request)
    {
        $reglas = [
            'preguntas' => 'required'
        ];
        $mensajes = [
            'preguntas.required' => 'Esta pregunta es obligatoria'
        ];

        $datos = $request->all();

        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {

            $sql = "SELECT r.id FROM respuesta_seguimiento r, investigacion_has_users ihu, respuesta_seguimiento_detalle rd
            WHERE ihu.id = r.id AND r.id_respuesta = rd.id_respuesta";
            $cuenta = (array) DB::select($sql);

            if (count($cuenta)) {
                return view('alertas.repetido')->render();
            } else {
            }
        }
    }
    public function showModalSeguimiento()
    {
        return view('modals.proyectos.seguimientoProyecto');
    }
}
