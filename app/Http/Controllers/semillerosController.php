<?php

namespace App\Http\Controllers;

use App\Models\Semilleros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class semillerosController extends Controller
{

    public function crearSemilleros(Request $request)
    {
        // dd($request->controladores);
        $controladores = $request->controladores;
        return view('crearSemilleros', compact('controladores'));
    }

    public function showSemilleros()
    {
        $semilleros = Semilleros::pagination('10');

        return view('consultarSemilleros', compact('semilleros'));
    }

    public function showRegistrarSemilleros()
    {
        return view('registrarSemilleros')->with(false, 'existe');
    }

    public function registrarSemilleros(Request $request)
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
