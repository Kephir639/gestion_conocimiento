<?php

namespace App\Http\Controllers;

use App\Models\GrupoInvestigacion;
use App\Models\Integrantes;
use App\Models\LineaInvestigacion;
use App\Models\Log;
use App\Models\Programas;
use App\Models\Redes;
use App\Models\Semilleros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class semillerosController extends Controller
{
    public function showSemilleros(Request $request)
    {
        $listaSemilleros = Semilleros::orderBy('id_semillero', 'desc')->paginate('10');
        $controladores = $request->controladores;

        return view('modals.semilleros.consultarSemilleros', [
            'listaSemilleros' => $listaSemilleros,
            'controladores' => $controladores
        ]);
    }

    public function showModalRegistrar()
    {
        $usuarios = Integrantes::where('estado_integrantes', 0)->orderBy('id_integrante', 'desc')->paginate('10');
        $grupos = GrupoInvestigacion::all();
        $lineas = LineaInvestigacion::all();
        $programas = Programas::all();
        $redes = Redes::all();

        return view('modals.semilleros.crearSemilleros', [
            'usuarios' => $usuarios,
            'grupos' => $grupos,
            'lineas' => $lineas,
            'programas' => $programas,
            'redes' => $redes
        ]);
    }

    public function showModalActualizar()
    {
        return view('modals.semilleros.modificarSemilleros');
    }

    public function showModalValidar()
    {
        $sql =
            "SELECT u.id, u.name, u.apellidos, u.identificacion, u.ficha,
            u.programa,shu.id_semillero shu.id, s.id_semillero
            FROM users s, semilleros_investigacion s, semilleros_has_user shu
            WHERE u.id = shu.id AND shu.id_semillero = s.id_semillero
            ORDER BY id_SemHasUser DESC";
        $info_integrantes = DB::select($sql);

        $integrantes = [];

        foreach ($info_integrantes as $integrante) {
            $id_usuario = $integrante->id;

            if (!isset($integrantes[$id_usuario])) {
                $integrantes[$id_usuario] = [
                    'nombre' => $integrante->name,
                    'apellido' => $integrante->apellidos,
                    'documento' => $integrante->identificacion,
                    'ficha' => $integrante->ficha,
                    'programa_formacion' => $integrante->programa
                ];
            }
        }

        return view('modals.semilleros.modalPendientes', ['integrantes' => $integrantes]);
    }

    public function validarUsuario(Request $request)
    {
        $aceptados = $request->aceptados;
        $idUsuarios = [];
        foreach ($aceptados as $aceptado) {
            $sql = "SELECT id FROM users WHERE identificacion = '" . $aceptados . "' ";
            $idUsuarios[] = DB::select($sql);
        }

        foreach ($idUsuarios as $id) {
            $sql = "UPDATE semilleros_has_user SET estado_shu = 1 WHERE id = '" . $id . "'";
            DB::update($sql);
        }

        $alerta = view('alertas.validacionExitosa')->render();
        return response()->json(['alerta' => $alerta]);
    }

    public function registrarSemilleros(Request $request)
    {
        $reglas = [
            'nombre_semillero' => 'required',
            'iniciales_semillero' => 'required',
            'fecha_creacion' => 'required|date',
            'integrantes' => 'required',
            'mision' => 'required',
            'vision' => 'required',
            'objetivo_general' => 'required',
            'objetivos_especificos' => 'required',
            'grupos' => 'required',
            'lineas' => 'required',
            'programas' => 'required',
            'redes' => 'required',
            'integrantes' => 'required',
            'actividades' => 'required',
            'tareas' => 'required',
            'responsables' => 'required',
            'frecuencia' => 'required',
            'estado' => 'required'
        ];

        $mensajes = [
            'nombre_semillero.required' => 'Este campo es obligatorio',
            'iniciales_semillero.required' => 'Este campo es obligatorio',
            'fecha_creacion.required' => 'Este campo es obligatorio',
            'fecha_creacion.date' => 'Este campo debe ser una fecha valida',
            'mision.required' => 'Este campo es obligatorio',
            'vision.required' => 'Este campo es obligatorio',
            'objetivo_general.required' => 'Este campo es obligatorio',
            'objetivos_especificos.required' => 'Este campo es obligatorio',
            'id_grupo.required' => 'Este campo es obligatorio',
            'id_plan.required' => 'Este campo es obligatorio',
            'estado.required' => 'Este campo es obligatorio'
        ];
        $validacion = Validator::make($request, $reglas, $mensajes);
        $datos = $request->all();
        unset($request['_token']);
        unset($request['controladores']);

        if ($validacion->fails()) {
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;
            return redirect()->back()->withErrors($respuestas['mensaje']);
        } else {
            $respuestas['error'] = false;
            if (Semilleros::where('nombre_semillero', $datos['nombre_semillero'])->exist()) {
                return response()->json(['estado' => false], 200);
            } else {
                $semillero = new Semilleros();

                $semillero->setIdSemilleroAttribute($request->id_semillero);
                $semillero->setNombreSemilleroAttribute($request->nombre_semillero);
                $semillero->setInicialesSemilleroAttribute($request->inciales_semillero);
                $semillero->setFechaCreacionAttribute($request->fecha_creacion);
                $semillero->setMisionAttribute($request->mision);
                $semillero->setVisionAttribute($request->vision);
                $semillero->setObjetivoGeneralAttribute($request->objetivo_general);
                $semillero->setObjetivosEspecificosAttribute($request->objetivos_especificos);
                $semillero->setIdGrupoAttribute($request->id_grupo);
                $semillero->setIdPlanAttribute($request->id_plan);
                $semillero->setEstadoSemilleroAttribute($request->estado_semillero);

                Semilleros::create($semillero->toArray());

                $sql = log_auditoria::createLog(
                    'semillero',
                    $semillero->getNombreSemilleroAttribute(),
                    'registro'
                );
                Log::insert($sql);

                return response()->json(['estado' => true], 200);
            }
        }
    }

    public function actualizarSemilleros(Request $request)
    {
        $reglas = [
            'nombre_semillero' => 'required',
            'iniciales_semillero' => 'required',
            'fecha_creacion' => 'required|date',
            'mision' => 'required',
            'vision' => 'required',
            'objetivo_general' => 'required',
            'objetivos_especificos' => 'required',
            'id_grupo' => 'required',
            'id_plan' => 'required',
            'estado' => 'required'
        ];

        $mensajes = [
            'nombre_semillero.required' => 'Este campo es obligatorio',
            'iniciales_semillero.required' => 'Este campo es obligatorio',
            'fecha_creacion.required' => 'Este campo es obligatorio',
            'fecha_creacion.date' => 'Este campo debe ser una fecha valida',
            'mision.required' => 'Este campo es obligatorio',
            'vision.required' => 'Este campo es obligatorio',
            'objetivo_general.required' => 'Este campo es obligatorio',
            'objetivos_especificos.required' => 'Este campo es obligatorio',
            'id_grupo.required' => 'Este campo es obligatorio',
            'id_plan.required' => 'Este campo es obligatorio',
            'estado.required' => 'Este campo es obligatorio'
        ];
        $validacion = Validator::make($request, $reglas, $mensajes);
        $datos = $request->all();
        unset($request['_token']);
        unset($request['controladores']);

        if ($validacion->fails()) {
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;
            return redirect()->back()->withErrors($respuestas['mensaje']);
        } else {
            $respuestas['error'] = false;
            if (Semilleros::where('nombre_semillero', $datos['nombre_semillero'])->exist()) {
                return redirect()->back()->with(true, 'existe');
            } else {
                $semillero = new Semilleros();

                $semillero->setIdSemilleroAttribute($request->id_semillero);
                $semillero->setNombreSemilleroAttribute($request->nombre_semillero);
                $semillero->setInicialesSemilleroAttribute($request->inciales_semillero);
                $semillero->setFechaCreacionAttribute($request->fecha_creacion);
                $semillero->setMisionAttribute($request->mision);
                $semillero->setVisionAttribute($request->vision);
                $semillero->setObjetivoGeneralAttribute($request->objetivo_general);
                $semillero->setObjetivosEspecificosAttribute($request->objetivos_especificos);
                $semillero->setIdGrupoAttribute($request->id_grupo);
                $semillero->setIdPlanAttribute($request->id_plan);
                $semillero->setEstadoSemilleroAttribute($request->estado_semillero);

                Semilleros::where('nombre_semillero', $datos['nombre_semillero_old'])->update($semillero->toArray());

                return response()->json(['estado' => true], 200);
            }
        }
    }
}
