<?php

namespace App\Http\Controllers;

use App\Models\CentrosFormacion;
use App\Models\GrupoInvestigacion;
use App\Models\LineaInvestigacion;
use App\Models\Log;
use App\Models\Programas;
use App\Models\ProyectosInvestigacion;
use App\Models\Redes;
use App\Models\Semilleros;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Array_;
use stdClass;

class proyectosInvestigacionController extends Controller
{

    public function showProyectosInvestigativos(Request $request)
    {
        $sql = "SELECT * FROM proyectos_investigacion pi, users u, investigacion_has_users ihu
        WHERE pi.id_p_investigacion = ihu.id_p_investigacion
        AND ihu.id = " . Auth::user()->id . " ORDER BY pi.id_p_investigacion DESC LIMIT 10 OFFSET 0";
        $listaProyectos =  DB::select($sql);
        // dd($listaProyectos);
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

                    // dd($datos);
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
                    for ($i = 0; $i < count($descripciones['descripciones']); $i++) {
                        $actividad = DB::table('investigacion_actividades_unificada')->insert([
                            'id_p_investigacion' => $proyecto->id,
                            'descripcion' => $descripciones['descripciones'][$i],
                            'enlace_evidencia' => $enlaces['enlaces'][$i],
                            'cumplido' => $cumplidos['cumplidos'][$i],
                            'estado_actividad_u_i' => 1
                        ]);
                        $id_actividad_i = DB::getPdo()->lastInsertId();
                        foreach ($actividades as $key => $arrayActividad) {
                            foreach ($arrayActividad as $actividad) {
                                DB::table('investigacion_actividades')->insert([
                                    'id_actividad_i' => $id_actividad_i,
                                    'actividad' => $actividad[$i],
                                    'estado_actividad_i' => 1
                                ]);
                            }
                        }
                        foreach ($entregables as $key => $arrayEntregables) {
                            foreach ($arrayEntregables as $entregable) {
                                DB::table('investigacion_entregables')->insert([
                                    'id_actividad_i' => $id_actividad_i,
                                    'entregable' => $entregable[$i],
                                    'estado_entregable_i' => 1
                                ]);
                            }
                        }
                        foreach ($observaciones as $key => $arrayobservaciones) {
                            foreach ($arrayobservaciones as $observacion) {
                                DB::table('investigacion_observaciones')->insert([
                                    'id_actividad_i' => $id_actividad_i,
                                    'observacion' => $observacion[$i],
                                    'estado_observacion_i' => 1
                                ]);
                            }
                        }
                    }
                    // dd($valores);
                    //Presupuestos
                    for ($i = 0; $i < count($conceptos['conceptos']); $i++) {
                        $presupuesto = DB::table('investigacion_presupuestos')->insert([
                            'id_p_investigacion' => $proyecto->id,
                            'concepto' => $conceptos['conceptos'][$i],
                            'rubro' => $rubros['rubros'][$i],
                            'uso_presupuestal' => $uso_presupuestal['uso_presupuestal'][$i],
                            'estado_presupuesto_i' => 1
                        ]);
                        $id_presupuesto_i = DB::getPdo()->lastInsertId();
                        foreach ($valores as $clave => $valor) {
                            foreach ($valor as $val) {
                                DB::table('investigacion_presupuestos_valores')->insert([
                                    'id_presupuesto_i' => $id_presupuesto_i,
                                    'valor' => $val[$i],
                                    'estado_valor_i' => 1
                                ]);
                            }
                        }
                    }
                    // dd("a");
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

    public function showModalActualizar(Request $request)
    {
        $proyecto = ProyectosInvestigacion::where('codigo_sigp', $request->codigo_sigp_old)->get();
        $id_proyecto = $proyecto[0]->id_p_investigacion;
        $centros = CentrosFormacion::all();
        $centros_proyecto = DB::table('investigacion_has_centros')->where('id_p_investigacion', $id_proyecto)->get();
        $grupos = GrupoInvestigacion::all();
        $grupos_proyecto = DB::table('investigacion_has_grupos')->where('id_p_investigacion', $id_proyecto)->get();
        $lineas = LineaInvestigacion::all();
        $lineas_proyecto = DB::table('investigacion_has_lineas')->where('id_p_investigacion', $id_proyecto)->get();
        $programas = Programas::all();
        $programas_proyecto = DB::table('investigacion_has_programas')->where('id_p_investigacion', $id_proyecto)->get();
        $redes = Redes::all();
        $redes_proyecto = DB::table('investigacion_has_redes')->where('id_p_investigacion', $id_proyecto)->get();
        $semilleros = Semilleros::all();
        $semilleros_proyecto = DB::table('investigacion_has_semilleros')->where('id_p_investigacion', $id_proyecto)->get();
        $users = User::all();
        $users_proyecto = DB::table('investigacion_has_users')->where('id_p_investigacion', $id_proyecto)->get();
        $objetivos_especificos = DB::table('investigacion_objetivos')->where('id_p_investigacion', $id_proyecto)->get();

        $actividadesC = DB::table('investigacion_actividades_unificada')
            ->where('id_p_investigacion', $id_proyecto)->orderBy('id_actividad_i', 'asc')->get();
        $actividades = $this->arrayActualizar($actividadesC, 'investigacion_actividades', 'id_actividad_i');
        $entregables = $this->arrayActualizar($actividadesC, 'investigacion_entregables', 'id_actividad_i');
        $observaciones = $this->arrayActualizar($actividadesC, 'investigacion_observaciones', 'id_actividad_i');

        $presupuestosC = DB::table('investigacion_presupuestos')
            ->where('id_p_investigacion', $id_proyecto)->orderBy('id_presupuesto_i', 'asc')->get();
        $valores = $this->arrayActualizar($presupuestosC, 'investigacion_presupuestos_valores', 'id_presupuesto_i');
        // dd($valores);
        $vista = view('modals.proyectos.investigacion.modificarProyectos', [
            'proyecto' => $proyecto,
            'centros' => $centros,
            'centros_proyecto' => $centros_proyecto,
            'grupos' => $grupos,
            'grupos_proyecto' => $grupos_proyecto,
            'lineas' => $lineas,
            'lineas_proyecto' => $lineas_proyecto,
            'programas' => $programas,
            'programas_proyecto' => $programas_proyecto,
            'redes' => $redes,
            'redes_proyecto' => $redes_proyecto,
            'semilleros' => $semilleros,
            'semilleros_proyecto' => $semilleros_proyecto,
            'participantes' => $users,
            'participantes_proyecto' => $users_proyecto,
            'objetivos' => $objetivos_especificos,
            'actividadesCompletas' => $actividadesC,
            'actividades' => $actividades,
            'entregables' => $entregables,
            'observaciones' => $observaciones,
            'presupuestosCompletos' => $presupuestosC,
            'valores' => $valores

        ])->render();
        return response()->json(['vista' => $vista]);
    }

    public function arrayActualizar($actividadesC, $nombreTabla, $identificador)
    {
        $arrayDatos = [];
        foreach ($actividadesC as $actividadC) {
            if (isset($actividadC->$identificador)) {
                $id_ac = strval($actividadC->$identificador);
                if (!in_array($id_ac, $arrayDatos)) {
                    $result = DB::table($nombreTabla)->where($identificador, $actividadC->$identificador)->get()->toArray();
                    $arrayDatos[$actividadC->$identificador] = $result;
                }
            } else {
                continue;
            }
        }
        // dd($arrayDatos);
        return $arrayDatos;
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

        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            // $proyecto = ProyectosInvestigacion::where('codigo_sigp_old', $datos['codigo_sigp_old'])->get();
            $identificador = 'id_p_investigacion';
            $tablas = [
                'investigacion_has_centros',
                'investigacion_has_grupos',
                'investigacion_has_lineas',
                'investigacion_has_programas',
                'investigacion_has_redes',
                'investigacion_has_semilleros',
                'investigacion_has_users',
                'proyectos_investigacion'
            ];
            $ajax = DB::table($tablas[7])
                ->where([
                    'ano_ejecucion' => $datos['ano_ejecucion'],
                    'codigo_sigp' => $datos['codigo_sigp_old'],
                    'nombre_proyecto' => $datos['nombre_proyecto'],
                    'resumen_proyecto' => $datos['resumen'],
                    'objetivo_general' => $datos['objetivo_general'],
                    'propuesta' => $datos['propuesta'],
                    'impacto' => $datos['impacto_esperado'],
                    'estado_p_investigacion' => $datos['estado_proyecto']
                ])
                ->join($tablas[0], $tablas[0] . '.' . $identificador,  $tablas[7] . '.' . $identificador . '')
                ->join($tablas[1], $tablas[1] . '.' . $identificador,  $tablas[7] . '.' . $identificador . '')
                ->join($tablas[2], $tablas[2] . '.' . $identificador,  $tablas[7] . '.' . $identificador . '')
                ->join($tablas[3], $tablas[3] . '.' . $identificador,  $tablas[7] . '.' . $identificador . '')
                ->join($tablas[4], $tablas[4] . '.' . $identificador,  $tablas[7] . '.' . $identificador . '')
                ->join($tablas[5], $tablas[5] . '.' . $identificador,  $tablas[7] . '.' . $identificador . '')
                ->join($tablas[6], $tablas[6] . '.' . $identificador,  $tablas[7] . '.' . $identificador . '')
                ->get();
            if (count($ajax)) {
                return view('alertas.repetido')->render();
            } else {
                try {
                    DB::beginTransaction();

                    $proyecto_investigacion = new ProyectosInvestigacion();

                    $proyecto_investigacion->ano_ejecucion = $request->ano_ejecucion;
                    $proyecto_investigacion->codigo_sigp = $request->codigo_sigp;
                    $proyecto_investigacion->nombre_proyecto = $request->nombre_proyecto;
                    $proyecto_investigacion->resumen_proyecto = $request->resumen;
                    $proyecto_investigacion->objetivo_general = $request->objetivo_general;
                    $proyecto_investigacion->propuesta = $request->propuesta;
                    $proyecto_investigacion->impacto = $request->impacto_esperado;
                    $proyecto_investigacion->estado_p_investigacion = $request->estado_proyecto;

                    ProyectosInvestigacion::where('codigo_sigp', $request->codigo_sigp_old)
                        ->update($proyecto_investigacion->toArray());
                    $proyecto = ProyectosInvestigacion::where('codigo_sigp', $request->codigo_sigp)->get();
                    // dd($datos);
                    $actividades = $proyecto_investigacion->actualizarArray($datos, 'actividades');
                    $entregables = $proyecto_investigacion->actualizarArray($datos, 'entregables');
                    $observaciones = $proyecto_investigacion->actualizarArray($datos, 'observaciones');
                    $descripciones = $proyecto_investigacion->actualizarArray($datos, 'descripciones');
                    $enlaces = $proyecto_investigacion->actualizarArray($datos, 'enlaces');
                    $cumplidos = $proyecto_investigacion->actualizarArray($datos, 'cumplidos');
                    $conceptos = $proyecto_investigacion->actualizarArray($datos, 'conceptos');
                    $rubros = $proyecto_investigacion->actualizarArray($datos, 'rubros');
                    $uso_presupuestal = $proyecto_investigacion->actualizarArray($datos, 'uso_presupuestal');
                    $valores = $proyecto_investigacion->actualizarArray($datos, 'valores');
                    // dd($actividades);
                    //Centros
                    $proyecto_investigacion->actualizarElementos(
                        $proyecto[0]->id_p_investigacion,
                        'investigacion_has_centros',
                        $request->centros,
                        'id_p_investigacion',
                        'id_centro',
                        'estado_ihc'
                    );
                    //Grupos
                    $proyecto_investigacion->actualizarElementos(
                        $proyecto[0]->id_p_investigacion,
                        'investigacion_has_grupos',
                        $request->grupos,
                        'id_p_investigacion',
                        'id_grupo',
                        'estado_ihg'
                    );
                    //Lineas
                    $proyecto_investigacion->actualizarElementos(
                        $proyecto[0]->id_p_investigacion,
                        'investigacion_has_lineas',
                        $request->lineas,
                        'id_p_investigacion',
                        'id_linea',
                        'estado_ihl'
                    );
                    //Redes
                    $proyecto_investigacion->actualizarElementos(
                        $proyecto[0]->id_p_investigacion,
                        'investigacion_has_redes',
                        $request->redes,
                        'id_p_investigacion',
                        'id_red',
                        'estado_ihr'
                    );
                    //Programas
                    $proyecto_investigacion->actualizarElementos(
                        $proyecto[0]->id_p_investigacion,
                        'investigacion_has_programas',
                        $request->programas,
                        'id_p_investigacion',
                        'id_programa',
                        'estado_ihp'
                    );
                    //Semilleros
                    $proyecto_investigacion->actualizarElementos(
                        $proyecto[0]->id_p_investigacion,
                        'investigacion_has_semilleros',
                        $request->semilleros,
                        'id_p_investigacion',
                        'id_semillero',
                        'estado_ihs'
                    );
                    //Participantes
                    $proyecto_investigacion->actualizarElementos(
                        $proyecto[0]->id_p_investigacion,
                        'investigacion_has_users',
                        $request->grupos,
                        'id_p_investigacion',
                        'id',
                        'estado_ihu'
                    );
                    //Objetivos Especificos
                    $proyecto_investigacion->actualizarElementos(
                        $proyecto[0]->id_p_investigacion,
                        'investigacion_objetivos',
                        $request->objetivos_especificos,
                        'id_p_investigacion',
                        'id_objetivo_i',
                        'estado_objetivo_i'
                    );
                    //Actividades
                    $listaActividades = DB::table('investigacion_actividades_unificada')
                        ->where('id_p_investigacion', $proyecto[0]->id_p_investigacion)->get();
                    $i = 0;
                    foreach ($listaActividades as $listAct) {
                        DB::table('investigacion_actividades_unificada')
                            ->where('id_actividad_i', $listAct->id_actividad_i)
                            ->update([
                                'id_p_investigacion' => $proyecto[0]->id_p_investigacion,
                                'descripcion' => $descripciones['descripciones'][$i],
                                'enlace_evidencia' => $enlaces['enlaces'][$i],
                                'cumplido' => $cumplidos['cumplidos'][$i],
                                'estado_actividad_u_i' => $datos['estado_proyecto']
                            ]);
                        foreach ($actividades as $key => $arrayActividad) {
                            foreach ($arrayActividad as $actividad => $act) {
                                foreach ($act as $actualizarAct)
                                    DB::table('investigacion_actividades')->where('id_actividad_i')
                                        ->update([
                                            'id_actividad_i' => $listAct->id_actividad_i,
                                            'actividad' => $actualizarAct,
                                            'estado_actividad_i' => $datos['estado_proyecto']
                                        ]);
                            }
                        }
                        foreach ($entregables as $key => $arrayEntregables) {
                            foreach ($arrayEntregables as $entregable => $entrg) {
                                foreach ($entrg as $entr) {
                                    DB::table('investigacion_entregables')->where('id_actividad_i')
                                        ->update([
                                            'id_actividad_i' => $listAct->id_actividad_i,
                                            'entregable' => $entr,
                                            'estado_entregable_i' => $datos['estado_proyecto']
                                        ]);
                                }
                            }
                        }
                        foreach ($observaciones as $key => $arrayobservaciones) {
                            foreach ($arrayobservaciones as $observacion => $obs) {
                                foreach ($obs as $actualizarObjetivo) {
                                    DB::table('investigacion_observaciones')->where('id_actividad_i')
                                        ->update([
                                            'id_actividad_i' => $listAct->id_actividad_i,
                                            'observacion' => $actualizarObjetivo,
                                            'estado_observacion_i' => $datos['estado_proyecto']
                                        ]);
                                }
                            }
                        }
                        $i++;
                    }

                    //Presupuestos
                    $listaPresupuestos = DB::table('investigacion_presupuestos')
                        ->where('id_p_investigacion', $proyecto[0]->id_p_investigacion)->get();
                    $i = 0;
                    foreach ($listaPresupuestos as $listaPres) {
                        DB::table('investigacion_presupuestos')
                            ->where('id_presupuesto_i', $listaPres->id_presupuesto_i)
                            ->update([
                                'id_p_investigacion' => $proyecto[0]->id_p_investigacion,
                                'concepto' => $conceptos['conceptos'][$i],
                                'rubro' => $rubros['rubros'][$i],
                                'uso_presupuestal' => $uso_presupuestal['uso_presupuestal'][$i],
                                'estado_presupuesto_i' => $datos['estado_proyecto']
                            ]);
                        foreach ($valores as $valor) {
                            // dd($valores);
                            DB::table('investigacion_presupuestos_valores')->where('id_presupuesto_i')
                                ->update([
                                    'id_presupuesto_i' => $listaPres->id_presupuesto_i,
                                    'valor' => $valor,
                                    'estado_valor_i' => $datos['estado_proyecto']
                                ]);
                        }
                        $i++;
                    }
                    // dd("a");
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return view('noHay');
                    dd($th);
                }
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
