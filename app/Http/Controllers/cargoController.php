<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Log;
use App\Models\Rol;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class cargoController extends Controller
{
    public function showCargos(Request $request)
    {
        $sql = "SELECT nombre_cargo, estado FROM cargos";

        $cargos = Cargo::orderBy('id_cargo', 'desc')->paginate(10);
        $controladores = $request->controladores;

        return view('modals.cargo.consultarCargos', compact('cargos', 'controladores'));
    }

    public function showModalRegistrar()
    {
        return view('modals.cargo.crearCargo');
    }


    public function registrarCargo(Request $request)
    {
        $reglas = [
            'nombre_cargo' => 'required',
            'estado_cargo' => 'required'
        ];

        $mensajes = [
            'nombre_cargo.required' => 'Este campo es obligatorio',
            'nombre_cargo.max' => 'Este campo debe contener maximo 30 caracteres',
            'estado_cargo.required' => 'Este campo es obligatorio'
        ];

        $datos = $request->all();
        $respuestas = [];
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $respuestas['error'] = false;
            $ajax = Cargo::where('nombre_cargo', $datos['inputNombreCargo'])->get();
            if (count($ajax)) {
                return view('alertas.repetido')->render();
            } else {
                $cargo = new Cargo();

                $cargo->setNombreCargoAttribute($request->nombre_cargo);
                $cargo->setEstadoAttribute(1);

                Cargo::create($cargo->toArray());

                $sql = log_auditoria::createLog(
                    'cargo',
                    $cargo->getNombreCargoAttribute(),
                    'registro'
                );
                Log::insert($sql);

                $listaCargos = Cargo::orderBy('id_cargo', 'desc')->paginate('10');
                $controladores = $request->controladores;

                $tabla = view('modals.cargo.tablaGrupo', [
                    'listaCargos' => $listaCargos,
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
        return view('modals.cargo.modificarCargo');
    }

    public function actualizarCargo(Request $request)
    {
        $reglas = [
            'nombre_cargo' => 'required|max:30',
            'estado_cargo' => 'required'
        ];
        $mensajes = [
            'nombre_cargo.required' => 'Este campo es obligatorio',
            'nombre_cargo.max' => 'Este campo debe contener maximo 30 caracteres',
            'estado_cargo.required' => 'Este campo es obligatorio'
        ];

        $respuestas = [];
        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        unset($datos['_token']);
        unset($datos['controladores']);
        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            $ajax = Cargo::where('nombre_cargo', $datos['nombre_cargo'])->get();
            if (count($ajax)) {
                return view('alertas.repetido');
            } else {
                $cargo = new Cargo();

                $cargo->setNombreCargoAttribute($request->nombre_cargo);
                $cargo->setEstadoAttribute($request->estado_cargo);

                Cargo::where('nombre_cargo', $datos['nombre_cargo_old'])->update($cargo);

                $sql = log_auditoria::createLog(
                    'cargo',
                    $datos['nombre_cargo_old'],
                    'actualizo',
                    $cargo->getNombreCargoAttribute()
                );
                Log::insert($sql);

                return view('alertas.modifcarExitoso');
            }
        }
    }
}
