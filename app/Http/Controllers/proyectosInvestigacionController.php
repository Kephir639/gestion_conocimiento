<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\proyectosInvestigacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class proyectosInvestigacionController extends Controller
{

    public function showProyectosInvestigativos(Request $request)
    {
        $listaProyectos = proyectosInvestigacion::orderBy('id_proyecto_investigacion', 'desc')->paginate('10');
        $controladores = $request->controladores;

        return view('modals.proyectos.investigacion.consultarProyectos', [
            'listaProyectos' => $listaProyectos,
            'controladores' => $controladores
        ]);
    }

    public function showModalRegistrar(Request $request)
    {
        return view('modals.proyectos.investigacion.crearProyectos');
    }

    public function showModalActualizar(Request $request)
    {
        return view('modals.proyectos.investigacion.modificarProyectos');
    }

    public function registrarProyectoInvestigacion(Request $request)
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
            // dd($validacion->errors());
        } else {
            $ajax = DB::table('proyectos_investigacion')->where('codigo_sigp', $datos['codigo_sigp'])->get();
            if (count($ajax)) {
                return view('alertas.repetido');
            } else {
                $proyecto_investigacion = new proyectosInvestigacion();

                $proyecto_investigacion->ano_ejecucion = $request->ano_ejecucion;
                $proyecto_investigacion->codigo_sigp = $request->codigo_sigp;
                $proyecto_investigacion->nombre_proyecto = $request->nombre_proyecto;
                $proyecto_investigacion->resumen_proyecto = $request->resumen_proyecto;
                $proyecto_investigacion->objetivo_general = $request->objetivo_general;
                $proyecto_investigacion->propuesta = $request->propuesta;
                $proyecto_investigacion->impacto = $request->impacto;

                $proyecto = proyectosInvestigacion::create($proyecto_investigacion->toArray());

                //Centros
                foreach ($request->centros as $centro) {
                    DB::table('investigacion_has_centros')->insert([
                        'id_p_investigacion' => $proyecto->id_p_investigacion,
                        'id_centro' => $centro,
                        'estado_ihc' => 1
                    ]);
                }
                //Grupos
                foreach ($request->grupos as $grupo) {
                    DB::table('investigacion_has_grupos')->insert([
                        'id_p_investigacion' => $proyecto->id_p_investigacion,
                        'id_grupo' => $grupo,
                        'estado_ihg' => 1
                    ]);
                }
                //Lineas
                foreach ($request->lineas as $linea) {
                    DB::table('investigacion_has_lineas')->insert([
                        'id_p_investigacion' => $proyecto->id_p_investigacion,
                        'id_linea' => $linea,
                        'estado_ihl' => 1
                    ]);
                }
                //Redes
                foreach ($request->redes as $red) {
                    DB::table('investigacion_has_redes')->insert([
                        'id_p_investigacion' => $proyecto->id_p_investigacion,
                        'id_red' => $red,
                        'estado_ihr' => 1
                    ]);
                }
                //Programas
                foreach ($request->programas as $programa) {
                    DB::table('investigacion_has_programas')->insert([
                        'id_p_investigacion' => $proyecto->id_p_investigacion,
                        'id_programa' => $programa,
                        'estado_ihp' => 1
                    ]);
                }
                //Semilleros
                foreach ($request->semilleros as $semillero) {
                    DB::table('investigacion_has_semilleros')->insert([
                        'id_p_investigacion' => $proyecto->id_p_investigacion,
                        'id_semillero' => $semillero,
                        'estado_ihs' => 1
                    ]);
                }
                //Participantes
                foreach ($request->participantes as $participantes) {
                    DB::table('investigacion_has_participantes')->insert([
                        'id_p_investigacion' => $proyecto->id_p_investigacion,
                        'id' => $participantes,
                        'estado_ihu' => 1
                    ]);
                }
                //Objetivos Especificos
                foreach ($request->objetivos_especificos as $objetivo_especifico) {
                    DB::table('investigacion_has_objetivos')->insert([
                        'id_p_investigacion' => $proyecto->id_p_investigacion,
                        'objetivo_especifico' => $objetivo_especifico,
                        'estado_objetivo_i' => 1
                    ]);
                }

                //ACtividades Conjunto - Descripcion, Enlace, Cumplido
                $actividad = DB::table('investigacion_actividades_unificada')->create([
                    'id_p_investigacion' => $proyecto->id_p_investigacion,
                    'descripcion' => $request->descripcion,
                    'enlace_evidencia' => $request->enlace_evidencia,
                    'cumplido' => $request->cumplido,
                    'estado_actividad_u_i' => 1
                ]);
                //Actividades
                foreach ($request->actividades as $actividad) {
                    DB::table('investigacion_actividades')->insert([
                        'id_actividad_i' => $actividad->id_actividad_i,
                        'actividad' => $actividad,
                        'estado_actividad_i' => 1
                    ]);
                }
                //Entregables
                foreach ($request->entregables as $entregable) {
                    DB::table('investigacion_entregables')->insert([
                        'id_actividad_i' => $actividad->id_actividad_i,
                        'entregable' => $entregable,
                        'estado_entregable_i' => 1
                    ]);
                }
                //Observaciones
                foreach ($request->observaciones as $observacion) {
                    DB::table('investigacion_observaciones')->insert([
                        'id_actividad_i' => $actividad->id_actividad_i,
                        'observacion' => $observacion,
                        'estado_observacion_i' => 1
                    ]);
                }

                //Presupuesto - Concepto Interno, Rubro, Uso presupuestal, Valores planteados*
                $presupuesto = DB::table('investigacion_presupuestos')->create([
                    'id_p_investigacion' => $proyecto->id_p_investigacion,
                    'concepto' => $request->concepto,
                    'rubro' => $request->rubro,
                    'uso_presupuestal' => $request->uso_presupuestal,
                    'estado_presupuesto_i' => 1
                ]);
                //Valores Planteados
                foreach ($request->valores_planteados as $valor) {
                    DB::table('investigacion_presupuestos_valores')->insert([
                        'id_presupuesto_i' => $presupuesto->id_presupuesto_i,
                        'valor' => $valor,
                        'estado_valor_i' => 1
                    ]);
                }


                $sql = log_auditoria::createLog(
                    'proyecto_investigacion',
                    $proyecto_investigacion->nombre_proyecto,
                    'registro'
                );
                Log::insert($sql);

                $listaProyectos = proyectosInvestigacion::orderBy('id_p_investigacion', 'desc')->paginate('10');
                $controladores = $request->controladores;

                $tabla = view('modals.redes.tablaRed', [
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

        $actividad = DB::table('investigacion_actividades_unificada')
            ->where('codigo_sigp', $request->codigo_sigp_old)
            ->get();

        $centros_actividad = DB::table('investigacion_has_centros')
            ->where('id_actividad_i', $actividad->id_actividad_i)
            ->get();

        foreach ($request->centros as $centro) {
            foreach ($centros_actividad as $centro_act) {
            }
        }
    }
}
