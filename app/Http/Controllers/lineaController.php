<?php

namespace App\Http\Controllers;

use App\Models\LineaInvestigacion;
use App\Models\Log;
use App\Models\Semilleros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class lineaController extends Controller
{
    public function showLineas()
    {
        $controladores = request()->controladores;
        $listaLineas = LineaInvestigacion::orderBy('id_linea', 'desc')->paginate('10');

        return view('modals.lineas.consultarLinea', [
            'listaLineas' => $listaLineas,
            'controladores' => $controladores
        ]);
    }

    public function showModalRegistrar()
    {
        return view('modals.lineas.crearLinea');
    }

    public function registrarLinea(Request $request)
    {
        $reglas = [
            'nombre_linea' => 'required'
        ];

        $mensajes = [
            'nombre_linea.required' => 'Este campo es obligatorio',
        ];

        $datos = $request->all();

        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            //Se regresa a la ruta anterior con los errores cometidos para ser mostrados en la vista
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {

            $ajax = LineaInvestigacion::where('nombre_linea', $datos['inputNombreLinea'])->get();
            if (count($ajax)) {
                return view('alertas.repetido')->render();
            } else {
                $linea = new LineaInvestigacion();

                $linea->setNombreLineaAttribute($request->nombre_linea);
                $linea->setEstadoAttribute(1);

                LineaInvestigacion::create($linea->toArray());

                $sql = log_auditoria::createLog(
                    'linea',
                    $linea->getNombreLineaAttribute(),
                    'registro'
                );
                Log::insert($sql);

                $listaLinea = LineaInvestigacion::orderBy('id_linea', 'desc')->paginate('10');
                $controladores = $request->controladores;

                $tabla = view('modals.lineas.tablaLineas', [
                    'listaLineas' => $listaLinea,
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

    public function showModalActualizar()
    {
        return view('modals.lineas.modificarLinea');
    }

    public function actualizarSemillero(Request $request)
    {
        // Definimos las reglas de validación
        $reglas = [
            'nombre_semillero' => 'required|max:150',
            'iniciales_semillero' => 'required|max:150',
            'lider_semillero' => 'required|max:255'
            // 'mision' => 'required|max:900',
            // 'vision' => 'required|max:900',
            // 'objetivo_general' => 'required|max:200',
            // 'id_grupo' => 'required|integer|exists:grupos,id' // Verificar si el grupo existe
        ];

        // Mensajes personalizados para la validación
        $mensajes = [
            'nombre_semillero.required' => 'El nombre del semillero es obligatorio.',
            'nombre_semillero.max' => 'El nombre del semillero no debe exceder 150 caracteres.',
            'iniciales_semillero.required' => 'Las iniciales del semillero son obligatorias.',
            'iniciales_semillero.max' => 'Las iniciales del semillero no deben exceder 150 caracteres.',
            'lider_semillero.required' => 'El líder del semillero es obligatorio.',
            'lider_semillero.max' => 'El nombre del líder no debe exceder 255 caracteres.'
            // 'mision.required' => 'La misión del semillero es obligatoria.',
            // 'mision.max' => 'La misión no debe exceder 900 caracteres.',
            // 'vision.required' => 'La visión del semillero es obligatoria.',
            // 'vision.max' => 'La visión no debe exceder 900 caracteres.',
            // 'objetivo_general.required' => 'El objetivo general es obligatorio.',
            // 'objetivo_general.max' => 'El objetivo general no debe exceder 200 caracteres.',
            // 'id_grupo.required' => 'El grupo del semillero es obligatorio.',
            // 'id_grupo.exists' => 'El grupo seleccionado no es válido.'
        ];

        // Realizamos la validación de los datos
        $validacion = Validator::make($request->all(), $reglas, $mensajes);

        // Si la validación falla, retornamos los errores
        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        }

        // Obtenemos todos los datos del request, excepto los campos innecesarios
        $datos = $request->except(['_token', 'controladores']);

        // Verificamos si ya existe un semillero con el mismo nombre y estado
        $semilleroExistente = Semilleros::where([
            'nombre_semillero' => $datos['nombre_semillero'],
            'iniciales_semillero' => $datos['iniciales_semillero']
        ])->first();

        // Si ya existe un semillero con el mismo nombre, mostramos un mensaje de advertencia
        if ($semilleroExistente) {
            return view('alertas.repetido');
        }

        // Si no existe, procedemos a la actualización
        $semillero = new Semilleros();
        $semillero->setNombreSemilleroAttribute($request->nombre_semillero);
        $semillero->setInicialesSemilleroAttribute($request->iniciales_semillero);
        $semillero->setLiderSemilleroAttribute($request->lider_semillero);
        // $semillero->setMisionAttribute($request->mision);
        // $semillero->setVisionAttribute($request->vision);
        // $semillero->setObjetivoGeneralAttribute($request->objetivo_general);
        // $semillero->setIdGrupoAttribute($request->id_grupo);

        // Actualizamos el semillero donde el nombre es el antiguo
        Semilleros::where('nombre_semillero', $request->nombre_semillero_old)->update($semillero->toArray());

        // Creamos el registro en el log de auditoría
        $sql = log_auditoria::createLog(
            'semillero',
            $request->nombre_semillero_old,
            'actualizó',
            $semillero->getNombreSemilleroAttribute()
        );
        Log::insert($sql);

        // Retornamos la vista de éxito
        return view('alertas.modificarExitoso');
    }
}
