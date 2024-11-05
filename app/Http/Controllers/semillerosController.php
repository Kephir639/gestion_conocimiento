<?php

namespace App\Http\Controllers;

use App\Models\GrupoInvestigacion;
use App\Models\Integrantes;
use App\Models\LineaInvestigacion;
use App\Models\Log;
use App\Models\Programas;
use App\Models\Redes;
use App\Models\Semilleros;
use App\Models\SemilleroObjetivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class semillerosController extends Controller
{
    public function showSemilleros(Request $request)
    {
        // Get all semilleros from the database
        $listaSemilleros = DB::table('semilleros_investigacion')->orderBy('id_semillero', 'desc')->paginate(10);
        $controladores = $request->controladores;
        // Return view with the list of semilleros
        return view('modals.semilleros.consultarSemilleros', compact('listaSemilleros', 'controladores'));
    }

    public function verSemilleros(Request $request)
    {
        // Buscar semillero usando las iniciales recibidas desde la petición
        $semillero = DB::table('semilleros_investigacion')
            ->where('iniciales_semillero', $request->iniciales)
            ->first(); // Cambié a first() para obtener un solo registro en lugar de una colección

        // Verificar si el semillero fue encontrado
        if (!$semillero) {
            return response()->json(['message' => 'Semillero no encontrado'], 404);
        }

        // Devolver la vista con los detalles del semillero
        return view('modals.semilleros.verSemilleros', compact('semillero'));
    }


    public function showModalRegistrar()
    {
        $usuarios = Integrantes::where('estado_integrantes', 0)->orderBy('id_integrante', 'desc')->paginate('10');
        $grupos = GrupoInvestigacion::all();
        $lineas = LineaInvestigacion::all();
        $programas = Programas::all();
        $redes = Redes::all();

        return view('modals.semilleros.creaSemilleros', [
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
        $sql = "
        SELECT u.id, u.name, u.apellidos, u.numero_identificacion, u.ficha,
               u.Nombre_programa, shu.id_semillero, s.id_semillero as id_semi
        FROM users u
        JOIN semilleros_has_user shu ON u.id = shu.id
        JOIN semilleros_investigacion s ON shu.id_semillero = s.id_semillero
        ORDER BY shu.id_SemHasUser DESC";

        $info_integrantes = DB::select($sql);

        $integrantes = [];

        foreach ($info_integrantes as $integrante) {
            $id_usuario = $integrante->id;

            if (!isset($integrantes[$id_usuario])) {
                //dd($info_integrantes);

                $integrantes[$id_usuario] = [
                    'nombre' => $integrante->name,
                    'apellido' => $integrante->apellidos,
                    'documento' => $integrante->numero_identificacion,
                    'ficha' => $integrante->ficha,
                    'programa_formacion' => $integrante->Nombre_programa,
                    'id_semillero' => $integrante->id_semillero
                ];
            }
        }

        return view('modals.semilleros.modalPendientes', compact('integrantes'));
    }




    public function validarUsuario(Request $request)
    {
        $aceptados = $request->aceptados;
        $idUsuarios = [];

        foreach ($aceptados as $aceptado) {
            // Consulta preparada para evitar inyecciones SQL
            $idUsuarios[] = DB::table('users')->where('identificacion', $aceptado)->pluck('id');
        }

        foreach ($idUsuarios as $idUsuario) {
            DB::table('semilleros_has_user')
                ->where('id_user', $idUsuario)
                ->update(['estado_shu' => 1]);
        }

        $alerta = view('alertas.validacionExitosa')->render();
        return response()->json(['alerta' => $alerta]);
    }


    public function registrarSemilleros(Request $request)
    {
        $reglas = [
            'nombre_semillero' => ['required', 'max:30', 'regex:/^[\pL\s]+$/u'],
            'iniciales_semillero' => ['required', 'max:10', 'regex:/^[\pL\s]+$/u'],
            'fecha_creacion' => 'required|date',
            'lider_semillero' => ['required', 'max:30', 'regex:/^[\pL\s]+$/u'],
            'mision' => ['required', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'vision' => ['required', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'objetivo_general' => 'required|string',
            'objetivos_especificos' => 'required|array',
            'objetivos_especificos.*' => 'required|string',
            'id_grupo' => 'required|integer',
        ];

        $mensajes = [
            'nombre_semillero.required' => 'Este campo es obligatorio',
            'string' => 'Este campo debe ser una cadena de texto',
            'max' => 'Este campo debe tener máximo :max caracteres',
            'integer' => 'Este campo debe ser un número entero',
            'date' => 'Este campo debe ser una fecha válida',
        ];

        // Validación de los datos
        $validacion = Validator::make($request->all(), $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json([
                'error' => true,
                'mensajes' => $validacion->errors()
            ], 400);
        }

        // Verificar si el semillero ya existe
        if (Semilleros::where('nombre_semillero', $request->nombre_semillero)->exists()) {
            return response()->json(['estado' => false, 'mensaje' => 'El semillero ya existe'], 409);
        }

        // Crear el semillero sin incluir el campo objetivos_especificos en la tabla de semilleros
        $semillero = new Semilleros();
        $semillero->nombre_semillero = $request->nombre_semillero;
        $semillero->iniciales_semillero = $request->iniciales_semillero;
        $semillero->fecha_creacion = $request->fecha_creacion;
        $semillero->lider_semillero = $request->lider_semillero;
        $semillero->mision = $request->mision;
        $semillero->vision = $request->vision;
        $semillero->objetivo_general = $request->objetivo_general;
        $semillero->id_grupo = $request->id_grupo;

        // Guardar el semillero
        $semillero->save();

        // Guardar los objetivos específicos en la tabla `semilleros_objetivos`
        foreach ($request->objetivos_especificos as $objetivo) {
            SemilleroObjetivo::create([
                'semillero_id' => $semillero->id_semillero,
                'objetivo_especifico' => $objetivo,
            ]);
        }

        // Registrar log de auditoría
        log_auditoria::createLog('semillero', $semillero->nombre_semillero, 'registro');

        return response()->json(['estado' => true, 'mensaje' => 'Semillero registrado correctamente'], 201);
    }


    public function actualizarSemilleros(Request $request)
    {
        $reglas = [
            'nombre_semillero' => ['required', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'iniciales_semillero' => ['required', 'max:30', 'regex:/^[\pL\s]+$/u'],
            'lider_semillero' => ['required', 'max:30', 'regex:/^[\pL\s]+$/u'],
        ];

        $mensajes = [
            'nombre_semillero.required' => 'Este campo es obligatorio',
            'nombre_semillero.max' => 'Este campo debe contener máximo 255 caracteres',
            'iniciales_semillero.required' => 'Este campo es obligatorio',
            'iniciales_semillero.max' => 'Este campo debe contener máximo 10 caracteres',
            'lider_semillero.required' => 'Este campo es obligatorio'
        ];

        $respuestas = [];
        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $respuestas['error'] = false;
            $semilleroExistente = Semilleros::where([
                ['nombre_semillero', '=', $datos['nombre_semillero']],
                ['iniciales_semillero', '=', $datos['iniciales_semillero']],
                ['lider_semillero', '=', $datos['lider_semillero']]
            ])->first();

            if ($semilleroExistente) {
                return view('alertas.repetido');
            } else {
                $semillero = new Semilleros();

                $semillero->setNombreSemilleroAttribute($request->nombre_semillero);
                $semillero->setInicialesSemilleroAttribute($request->iniciales_semillero);
                $semillero->setLiderSemilleroAttribute($request->lider_semillero);

                Semilleros::where('nombre_semillero', $datos['nombre_semillero_old'])->update($semillero->toArray());

                $sql = log_auditoria::createLog(
                    'semillero',
                    $datos['nombre_semillero_old'],
                    'actualizo',
                    $semillero->getNombreSemilleroAttribute()
                );
                log::insert($sql);

                return view('alertas.modificarExitoso');
            }
        }
    }
}
