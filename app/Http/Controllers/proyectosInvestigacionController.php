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
    #Inicio consultas
    public function showProyectosInvestigativos(Request $request) //Muestra la vista con los proyectos vinculados al usuario
    {
        //Sql que trae los proyectos vinculados al usuario
        $sql = "SELECT * FROM proyectos_investigacion pi, investigacion_has_users ihu
        WHERE pi.id_p_investigacion = ihu.id_p_investigacion
        AND ihu.id = " . Auth::user()->id . " ORDER BY pi.id_p_investigacion DESC LIMIT 6 OFFSET 0";
        //En este caso solo el administrador puede ver todos los proyectos registrados
        $listaProyectos = (Auth::user()->idRol != 1) ? DB::select($sql) : DB::table('proyectos_investigacion')->orderBy('id_p_investigacion', 'desc')->paginate(6);
        $controladores = $request->controladores;
        return view('modals.proyectos.investigacion.consultarProyectos', [
            'listaProyectos' => $listaProyectos,
            'controladores' => $controladores
        ]);
    }

    public function showModalRegistrar(Request $request) //Muestra la modal para registrar un proyecto
    {
        $centros = CentrosFormacion::where('estado_centro', 1)->get();
        $grupos = GrupoInvestigacion::where('estado_grupo', 1)->get();
        $lineas = LineaInvestigacion::where('estado_linea', 1)->get();
        $redes = Redes::where('estado_red', 1)->get();
        $programas = Programas::where('estado_programa', 1)->get();
        $semilleros = Semilleros::where('estado_semillero', 1)->get();
        $participantes = User::where('estado_usu', 1)->get();

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

    public function showModalActualizar(Request $request) //Manda la modal de actualizar proyecto
    {
        //Obtenemos los datos para los selectores y los campos que ya estan vinculados al proyecto
        $proyecto = ProyectosInvestigacion::where('codigo_sigp', $request->codigo_sigp_old)->get();
        $id_proyecto = $proyecto[0]->id_p_investigacion;
        $centros = CentrosFormacion::where('estado_centro', 1)->get();
        $centros_proyecto = DB::table('investigacion_has_centros')->where('id_p_investigacion', $id_proyecto)->get();
        $grupos = GrupoInvestigacion::where('estado_grupo', 1)->get();
        $grupos_proyecto = DB::table('investigacion_has_grupos')->where('id_p_investigacion', $id_proyecto)->get();
        $lineas = LineaInvestigacion::where('estado_linea', 1)->get();
        $lineas_proyecto = DB::table('investigacion_has_lineas')->where('id_p_investigacion', $id_proyecto)->get();
        $programas = Programas::where('estado_programa', 1)->get();
        $programas_proyecto = DB::table('investigacion_has_programas')->where('id_p_investigacion', $id_proyecto)->get();
        $redes = Redes::where('estado_red', 1)->get();
        $redes_proyecto = DB::table('investigacion_has_redes')->where('id_p_investigacion', $id_proyecto)->get();
        $semilleros = Semilleros::where('estado_semillero', 1)->get();
        $semilleros_proyecto = DB::table('investigacion_has_semilleros')->where('id_p_investigacion', $id_proyecto)->get();
        $users = User::where('estado_usu', 1)->get();
        $users_proyecto = DB::table('investigacion_has_users')->where('id_p_investigacion', $id_proyecto)->get();
        $objetivos_especificos = DB::table('investigacion_objetivos')->where('id_p_investigacion', $id_proyecto)->get();

        //Obtenemos las actividades y los campos de las tablas intermedias de actividades
        $actividadesC = DB::table('investigacion_actividades_unificada')
            ->where('id_p_investigacion', $id_proyecto)->orderBy('id_actividad_i', 'asc')->get();
        $actividades = $this->arrayActualizar($actividadesC, 'investigacion_actividades', 'id_actividad_i');
        $entregables = $this->arrayActualizar($actividadesC, 'investigacion_entregables', 'id_actividad_i');
        $observaciones = $this->arrayActualizar($actividadesC, 'investigacion_observaciones', 'id_actividad_i');
        //Obtenemos los presupuestos y los campos de las tablas intermedias de presupuestas
        $presupuestosC = DB::table('investigacion_presupuestos')
            ->where('id_p_investigacion', $id_proyecto)->orderBy('id_presupuesto_i', 'asc')->get();
        $valores = $this->arrayActualizar($presupuestosC, 'investigacion_presupuestos_valores', 'id_presupuesto_i');


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
    #Fin consultas

    #Inicio peticiones
    public function registrarProyectoInvestigacion(Request $request) //Proceso de registro del proyecto de investigacion
    {
        // dd($request->all());
        $reglas = [
            'ano_ejecucion' => 'required|max:4|regex:/^[0-9]+$/',
            'codigo_sigp' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
            'nombre_proyecto' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            // 'centros' => 'required|regex:/^[1-9]+$/',
            // 'grupos' => 'required|regex:/^[1-9]+$/',
            // 'lineas' => 'required|regex:/^[1-9]+$/',
            // 'redes' => 'required|regex:/^[1-9]+$/',
            // 'programas' => 'required|regex:/^[1-9]+$/',
            // 'semilleros' => 'required|regex:/^[1-9]+$/',
            // 'participantes' => 'required|regex:/^[1-9]+$/',
            'resumen' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'objetivo_general' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            // 'objetivos_especificos' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'propuesta' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'impacto_esperado' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            // 'actividades' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            // 'presupuestos' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/'
        ];
        $mensajes = [
            'ano_ejecucion.required' => 'Este campo es obligatorio',
            'ano_ejecucion.regex' => 'Este campo solo puede contener letras y numeros',
            'codigo_sigp.required' => 'Este campo es obligatorio',
            'codigo_sigp.regex' => 'Este campo solo puede contener letras y numeros',
            'nombre_proyecto.required' => 'Este campo es obligatorio',
            'nombre_proyecto.regex' => 'Este campo solo puede contener letras y numeros',
            'centros.required' => 'Este campo es obligatorio',
            'centros.regex' => 'Seleccione una opcion valida😡',
            'grupos.required' => 'Este campo es obligatorio',
            'grupos.regex' => 'Seleccione una opcion valida😡',
            'lineas.required' => 'Este campo es obligatorio',
            'lineas.regex' => 'Seleccione una opcion valida😡',
            'redes.required' => 'Este campo es obligatorio',
            'redes.regex' => 'Seleccione una opcion valida😡',
            'programas.required' => 'Este campo es obligatorio',
            'programas.regex' => 'Seleccione una opcion valida😡',
            'semilleros.required' => 'Este campo es obligatorio',
            'semilleros.regex' => 'Seleccione una opcion valida😡',
            'participantes.required' => 'Este campo es obligatorio',
            'participantes.regex' => 'Seleccione una opcion valida😡',
            'resumen.required' => 'Este campo es obligatorio',
            'resumen.regex' => 'Este campo solo puede contener letras y numeros',
            'objetivo_general.required' => 'Este campo es obligatorio',
            'objetivo_general.regex' => 'Este campo solo puede contener letras y numeros',
            'objetivos_especificos.required' => 'Este campo es obligatorio',
            'objetivos_especificos.regex' => 'Este campo solo puede contener letras y numeros',
            'propuesta.required' => 'Este campo es obligatorio',
            'propuesta.regex' => 'Este campo solo puede contener letras y numeros',
            'impacto_esperado.required' => 'Este campo es obligatorio',
            'impacto_esperado.regex' => 'Este campo solo puede contener letras y numeros',
            'actividades.required' => 'Este campo es obligatorio',
            'actividades.regex' => 'Este campo solo puede contener letras y numeros',
            'presupuestos.required' => 'Este campo es obligatorio',
            'presupuestos.regex' => 'Este campo solo puede contener letras y numeros'
        ];
        $datos = $request->all();
        unset($datos['controladores']);

        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = DB::table('proyectos_investigacion')->where('codigo_sigp', $datos['codigo_sigp'])->get();
            if (count($ajax)) {
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
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

                    $actividades = $this->crearArray($datos, 'actividades');
                    $entregables = $this->crearArray($datos, 'entregables');
                    $observaciones = $this->crearArray($datos, 'observaciones');
                    $descripciones = $this->crearArray($datos, 'descripciones');
                    $enlaces = $this->crearArray($datos, 'enlaces');
                    $cumplidos = $this->crearArray($datos, 'cumplidos');
                    $conceptos = $this->crearArray($datos, 'conceptos');
                    $rubros = $this->crearArray($datos, 'rubros');
                    $uso_presupuestal = $this->crearArray($datos, 'uso_presupuestal');
                    $valores = $this->crearArray($datos, 'valores');

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
                            if (isset($arrayActividad[$i])) {
                                foreach ($arrayActividad[$i] as $actividad) {
                                    DB::table('investigacion_actividades')->insert([
                                        'id_actividad_i' => $id_actividad_i,
                                        'actividad' => $actividad,
                                        'estado_actividad_i' => 1
                                    ]);
                                }
                            }
                        }
                        foreach ($entregables as $key => $arrayEntregables) {
                            if (isset($arrayEntregables[$i])) {
                                foreach ($arrayEntregables[$i] as $entregable) {
                                    DB::table('investigacion_entregables')->insert([
                                        'id_actividad_i' => $id_actividad_i,
                                        'entregable' => $entregable,
                                        'estado_entregable_i' => 1
                                    ]);
                                }
                            }
                        }
                        foreach ($observaciones as $key => $arrayobservaciones) {
                            if (isset($arrayobservaciones[$i])) {
                                foreach ($arrayobservaciones[$i] as $observacion) {
                                    DB::table('investigacion_observaciones')->insert([
                                        'id_actividad_i' => $id_actividad_i,
                                        'observacion' => $observacion,
                                        'estado_observacion_i' => 1
                                    ]);
                                }
                            }
                        }
                    }
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
                            if (isset($valor[$i])) {
                                foreach ($valor[$i] as $val) {
                                    DB::table('investigacion_presupuestos_valores')->insert([
                                        'id_presupuesto_i' => $id_presupuesto_i,
                                        'valor' => $val,
                                        'estado_valor_i' => 1
                                    ]);
                                }
                            }
                        }
                    }
                    $sql = log_auditoria::createLog(
                        'proyecto_investigacion',
                        $proyecto_investigacion->nombre_proyecto,
                        'registro'
                    );
                    Log::insert($sql);

                    DB::commit();

                    $listaProyectos = proyectosInvestigacion::orderBy('id_p_investigacion', 'desc')->paginate('10');
                    $controladores = $request->controladores;
                    $tabla = view('modals.proyectos.investigacion.tablaProyectos', [
                        'listaProyectos' => $listaProyectos,
                        'controladores' => $controladores
                    ])->render();
                    $alerta = view('alertas.registrarExitoso')->render();

                    return response()->json([
                        'tabla' => $tabla,
                        'alerta' => $alerta
                    ]);
                } catch (\Throwable $th) {
                    dd($th);
                    DB::rollBack();
                    $alerta = view('alertas.registroError')->render();
                    return response()->json(['alerta' => $alerta]);
                }
            }
        }
    }

    public function actualizarProyectoInvestigacion(Request $request) //Proceso de actualizacion del proyecto
    {
        $reglas = [
            'ano_ejecucion' => 'required|max:4|regex:/^[0-9]+$/',
            'codigo_sigp' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
            'nombre_proyecto' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            // 'centros' => 'required|regex:/^[1-9]+$/',
            // 'grupos' => 'required|regex:/^[1-9]+$/',
            // 'lineas' => 'required|regex:/^[1-9]+$/',
            // 'redes' => 'required|regex:/^[1-9]+$/',
            // 'programas' => 'required|regex:/^[1-9]+$/',
            // 'semilleros' => 'required|regex:/^[1-9]+$/',
            // 'participantes' => 'required|regex:/^[1-9]+$/',
            'resumen' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'objetivo_general' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            // 'objetivos_especificos' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'propuesta' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'impacto_esperado' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            // 'actividades' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            // 'presupuestos' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'estado_p_investigacion' => 'required|regex:/^[0-1]+$/'
        ];
        $mensajes = [
            'ano_ejecucion.required' => 'Este campo es obligatorio',
            'ano_ejecucion.regex' => 'Este campo solo puede contener letras y numeros',
            'codigo_sigp.required' => 'Este campo es obligatorio',
            'codigo_sigp.regex' => 'Este campo solo puede contener letras y numeros',
            'nombre_proyecto.required' => 'Este campo es obligatorio',
            'nombre_proyecto.regex' => 'Este campo solo puede contener letras y numeros',
            'centros.required' => 'Este campo es obligatorio',
            'centros.regex' => 'Seleccione una opcion valida😡',
            'grupos.required' => 'Este campo es obligatorio',
            'grupos.regex' => 'Seleccione una opcion valida😡',
            'lineas.required' => 'Este campo es obligatorio',
            'lineas.regex' => 'Seleccione una opcion valida😡',
            'redes.required' => 'Este campo es obligatorio',
            'redes.regex' => 'Seleccione una opcion valida😡',
            'programas.required' => 'Este campo es obligatorio',
            'programas.regex' => 'Seleccione una opcion valida😡',
            'semilleros.required' => 'Este campo es obligatorio',
            'semilleros.regex' => 'Seleccione una opcion valida😡',
            'participantes.required' => 'Este campo es obligatorio',
            'participantes.regex' => 'Seleccione una opcion valida😡',
            'resumen.required' => 'Este campo es obligatorio',
            'resumen.regex' => 'Este campo solo puede contener letras y numeros',
            'objetivo_general.required' => 'Este campo es obligatorio',
            'objetivo_general.regex' => 'Este campo solo puede contener letras y numeros',
            'objetivos_especificos.required' => 'Este campo es obligatorio',
            'objetivos_especificos.regex' => 'Este campo solo puede contener letras y numeros',
            'propuesta.required' => 'Este campo es obligatorio',
            'propuesta.regex' => 'Este campo solo puede contener letras y numeros',
            'impacto_esperado.required' => 'Este campo es obligatorio',
            'impacto_esperado.regex' => 'Este campo solo puede contener letras y numeros',
            'actividades.required' => 'Este campo es obligatorio',
            'actividades.regex' => 'Este campo solo puede contener letras y numeros',
            'presupuestos.required' => 'Este campo es obligatorio',
            'presupuestos.regex' => 'Este campo solo puede contener letras y numeros',
            'estado_p_investigacion.required' => 'Este campo es obligatorio',
            'estado_p_investigacion.regex' => 'Seleccione una opcion valida😡',

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
                    'estado_p_investigacion' => $datos['estado_p_investigacion']
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
                //Respuesta en caso de que el objeto que se quiere crear ya exista en la base de datos
                $alerta = view('alertas.repetido')->render();
                return response()->json(['alerta' => $alerta]);
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
                    $proyecto_investigacion->estado_p_investigacion = $request->estado_p_investigacion;

                    if (DB::table('proyectos_investigacion')->where('codigo_sigp', $request->codigo_sigp_old)
                        ->update($proyecto_investigacion->toArray())
                    ) {
                        $proyecto = ProyectosInvestigacion::where('codigo_sigp', $request->codigo_sigp)->get();

                        $actividades = $this->actualizarArray($datos, 'actividades');
                        $entregables = $this->actualizarArray($datos, 'entregables');
                        $observaciones = $this->actualizarArray($datos, 'observaciones');
                        $descripciones = $this->actualizarArray($datos, 'descripciones');
                        $enlaces = $this->actualizarArray($datos, 'enlaces');
                        $cumplidos = $this->actualizarArray($datos, 'cumplidos');
                        $conceptos = $this->actualizarArray($datos, 'conceptos');
                        $rubros = $this->actualizarArray($datos, 'rubros');
                        $uso_presupuestal = $this->actualizarArray($datos, 'uso_presupuestal');
                        $valores = $this->actualizarArray($datos, 'valores');

                        //Centros
                        $this->actualizarElementos(
                            $proyecto[0]->id_p_investigacion,
                            'investigacion_has_centros',
                            $request->centros,
                            'id_p_investigacion',
                            'id_centro',
                            'estado_ihc'
                        );
                        //Grupos
                        $this->actualizarElementos(
                            $proyecto[0]->id_p_investigacion,
                            'investigacion_has_grupos',
                            $request->grupos,
                            'id_p_investigacion',
                            'id_grupo',
                            'estado_ihg'
                        );
                        //Lineas
                        $this->actualizarElementos(
                            $proyecto[0]->id_p_investigacion,
                            'investigacion_has_lineas',
                            $request->lineas,
                            'id_p_investigacion',
                            'id_linea',
                            'estado_ihl'
                        );
                        //Redes
                        $this->actualizarElementos(
                            $proyecto[0]->id_p_investigacion,
                            'investigacion_has_redes',
                            $request->redes,
                            'id_p_investigacion',
                            'id_red',
                            'estado_ihr'
                        );
                        //Programas
                        $this->actualizarElementos(
                            $proyecto[0]->id_p_investigacion,
                            'investigacion_has_programas',
                            $request->programas,
                            'id_p_investigacion',
                            'id_programa',
                            'estado_ihp'
                        );
                        //Semilleros
                        $this->actualizarElementos(
                            $proyecto[0]->id_p_investigacion,
                            'investigacion_has_semilleros',
                            $request->semilleros,
                            'id_p_investigacion',
                            'id_semillero',
                            'estado_ihs'
                        );
                        //Participantes
                        $this->actualizarElementos(
                            $proyecto[0]->id_p_investigacion,
                            'investigacion_has_users',
                            $request->grupos,
                            'id_p_investigacion',
                            'id',
                            'estado_ihu'
                        );
                        //Objetivos Especificos
                        $this->actualizarElementos(
                            $proyecto[0]->id_p_investigacion,
                            'investigacion_objetivos',
                            $request->objetivos_especificos,
                            'id_p_investigacion',
                            'id_objetivo_i',
                            'estado_objetivo_i'
                        );
                        /* !!!IMPORTANTE¡¡¡
                            El sistema debe mejorarse de manera que se detecte cuales campos fueron eliminados y cuales fueron agregados,
                            se puede tomar como ejemplo la funcion actualizarElementos que realiza esta funcion pero para arrays simples.
                            Copiar, pegar y adaptarlo para que funcione con la informacion de los Arrays anidados de los campos dinamicos 
                            del formulario.            
                            Ahora mismo el sistema solo actualiza el elemento solo si la clave del elemento es el ID del mismo(El cual se
                            otorga por medio de la logica de la vista y de la funcion arrayActualizar que toma los id de los inputs del
                            formulario y se los pone a la clave de los elementos en el array anidado*/

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
                                    'estado_actividad_u_i' => $datos['estado_p_investigacion']
                                ]);
                            foreach ($actividades as $key => $arrayActividad) {
                                if (isset($arrayActividad[$i])) {
                                    foreach ($arrayActividad[$i] as $IDactividad => $actividad) {
                                        DB::table('investigacion_actividades')->where('id_actividad', $IDactividad)
                                            ->update([
                                                'id_actividad_i' => $listAct->id_actividad_i,
                                                'actividad' => $actividad,
                                                'estado_actividad_i' => $datos['estado_p_investigacion']
                                            ]);
                                    }
                                }
                            }
                            foreach ($entregables as $key => $arrayEntregables) {
                                if (isset($arrayEntregables[$i])) {
                                    foreach ($arrayEntregables[$i] as $IDentregable => $entregable) {
                                        DB::table('investigacion_entregables')->where('id_entregable_i', $IDentregable)
                                            ->update([
                                                'id_actividad_i' => $listAct->id_actividad_i,
                                                'entregable' => $entregable,
                                                'estado_entregable_i' => $datos['estado_p_investigacion']
                                            ]);
                                    }
                                }
                            }
                            foreach ($observaciones as $key => $arrayobservaciones) {
                                if (isset($arrayobservaciones[$i])) {
                                    foreach ($arrayobservaciones[$i] as $IDobservacion => $observacion) {
                                        DB::table('investigacion_observaciones')->where('id_observacion', $IDobservacion)
                                            ->update([
                                                'id_actividad_i' => $listAct->id_actividad_i,
                                                'observacion' => $observacion,
                                                'estado_observacion_i' => $datos['estado_p_investigacion']
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
                                    'estado_presupuesto_i' => $datos['estado_p_investigacion']
                                ]);
                            foreach ($valores as $arrayValor) {
                                if (isset($arrayValor[$i])) {
                                    foreach ($arrayValor[$i] as $valor) {
                                        DB::table('investigacion_presupuestos_valores')->where('id_presupuesto_i')
                                            ->update([
                                                'id_presupuesto_i' => $listaPres->id_presupuesto_i,
                                                'valor' => $valor,
                                                'estado_valor_i' => $datos['estado_p_investigacion']
                                            ]);
                                    }
                                }
                            }
                            $i++;
                        }

                        DB::commit();

                        $listaProyectos = proyectosInvestigacion::orderBy('id_p_investigacion', 'desc')->paginate('10');
                        $controladores = $request->controladores;
                        $tabla = view('modals.proyectos.investigacion.tablaProyectos', [
                            'listaProyectos' => $listaProyectos,
                            'controladores' => $controladores
                        ])->render();
                        $alerta = view('alertas.modificarExitoso')->render();

                        return response()->json([
                            'tabla' => $tabla,
                            'alerta' => $alerta
                        ]);
                    }
                } catch (\Throwable $th) {
                    dd($th);
                    DB::rollBack();
                    $alerta = view('alertas.modificarError')->render();
                    return response()->json(['alerta' => $alerta]);
                }
            }
        }
    }
    #Fin peticiones

    #Funciones Individuales

    public function agregarActividad(Request $request) //Funcion que devuelve un nuevo campo de actividad
    {
        $contador_actividad = $request->contador_actividad;

        return view('modals.proyectos.investigacion.div.divActividad', [
            'contador_actividad' => $contador_actividad
        ])->render();
    }

    public function agregarPresupuesto(Request $request) //Funcion que devuelve un nuevo campo de presupuesto
    {
        $contador_presupuesto = $request->contador_presupuesto;

        return view('modals.proyectos.investigacion.div.divPresupuesto', [
            'contador_presupuesto' => $contador_presupuesto
        ])->render();
    }

    //Esta funcion se encarga de obtener los datos de las tablas intermedias para acomodarlos en arrays anidados
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
        return $arrayDatos;
    }

    /*Esta funcion se encarga de registrar o actualizar los campos multiples segun sea necesario,
    lo hace comparando el array de elementos existentes con el array de items recibido, entonces
    se decide, si es necesario actualizar el estado del registro en la tabla intermedia(en caso de
    que se haya "Eliminado") a inactivo(0), se tenga que registrar en caso de que aun no exista en la BD,
    y tambien cambiar el estado a Activo(1) en caso de que se haya agregado y exista en la BD*/
    public function actualizarElementos(
        $id_proyecto,
        $tabla_cambios, //Investigacion_Has_#
        $arrayComparacion, //Array de elementos seleccionados
        $campoGeneral,
        $campoDiffEspecifico, //Llave foranea especifica de cada tabla
        $campoEstado //Campo estado de la tabla
    ) {
        $proyecto = DB::table('proyectos_investigacion')
            ->where('id_p_investigacion', $id_proyecto)
            ->get();
        $elementos = DB::table($tabla_cambios)
            ->where($campoGeneral, $proyecto->first()->id_p_investigacion)
            ->get();
        $array_elementos = [];
        foreach ($elementos as $elemento) {
            array_push($array_elementos, strval($elemento->$campoDiffEspecifico));
        }
        $elementos_agregados = array_diff($array_elementos, $arrayComparacion);
        $elementos_eliminados = array_diff($arrayComparacion, $array_elementos);

        foreach ($elementos_agregados as $agregado) {
            if (count(DB::table($tabla_cambios)
                ->where($campoDiffEspecifico, $agregado)->get())) {
                DB::table($tabla_cambios)->where([
                    $campoDiffEspecifico => $agregado,
                    $campoGeneral => $proyecto->first()->id_p_investigacion
                ])->update([$campoEstado => 1]);
            } else {
                DB::table($tabla_cambios)->where($campoGeneral, $proyecto->first()->id_p_investigacion)
                    ->insert([
                        $campoGeneral => $proyecto->first()->id_p_investigacion,
                        $campoDiffEspecifico => $agregado,
                        $campoEstado => 1
                    ]);
            }
        }
        foreach ($elementos_eliminados as $eliminado) {
            DB::table($tabla_cambios)->where($campoDiffEspecifico, $eliminado)
                ->update([
                    $campoEstado => 0
                ]);
        }
    }

    /*Esta funcion se encarga re recorrer el array de valores($datos) enviado por el formulario y crear
    un array nuevo que contenga solamente los elementos del array seleccionado($clave), de cada actividad
    o presupuesto*/
    public function crearArray($datos, $clave)
    {
        $arrayUnico = [];
        foreach ($datos as $key => $valor) {
            //Accede a los arrays anidados con las respuestas de los campos dinamicos
            if ($key === 'actividades' || $key === 'presupuestos') {
                foreach ($valor as $llave => $array) {
                    if ($llave == $clave) { //Accede al array de respuestas que necesitamos
                        if (!isset($arrayUnico[$llave])) {
                            $arrayUnico[$llave] = [];
                        }
                        foreach ($array as $arr => $multiple) {
                            if (is_array($multiple)) { //Ingresa si es un array anidado que contiene los campos dinamicos
                                foreach ($multiple as $ky => $val) {
                                    if (!isset($arrayUnico[$llave][$arr])) {
                                        $arrayUnico[$llave][$arr] = [];
                                    }
                                    array_push($arrayUnico[$llave][$arr], $val);
                                }
                            } else { //En caso de ser un campo simple se registran las respuestas en un array
                                array_push($arrayUnico[$llave], $multiple);
                            }
                        }
                    }
                }
            }
        }
        return $arrayUnico;
    }

    /*Realiza el mismo trabajo que la funcion crearArray, solo que, en este caso necesitamos que la clave del
    nuevo array coincida con las claves de la informacion que pasamos, esto porque esas claves son el id correspondiente
    al registro de la BD y con el seremos capaces de determinar si se agrego un elemento nuevo, si se elimino uno existente
    o si se agrego uno que ya exisistia*/
    public function actualizarArray($datos, $clave)
    {
        $arrayUnico = [];
        foreach ($datos as $key => $valor) {
            if ($key === 'actividades' || $key === 'presupuestos') {
                foreach ($valor as $llave => $array) {
                    if ($llave == $clave) {
                        if (!isset($arrayUnico[$llave])) {
                            $arrayUnico[$llave] = [];
                        }
                        foreach ($array as $arr => $multiple) {
                            if (is_array($multiple)) {
                                if (!isset($arrayUnico[$llave][$arr])) {
                                    $arrayUnico[$llave][$arr] = $multiple;
                                }
                            } else {
                                array_push($arrayUnico[$llave], $multiple);
                            }
                        }
                    }
                }
            }
        }
        return $arrayUnico;
    }
}
