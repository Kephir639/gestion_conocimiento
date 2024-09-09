<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Rol;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class cargoController extends Controller
{
    public function showCargos()
    {
        $sql = "SELECT nombre_cargo, estado FROM cargos";

        $lista = Cargo::select($sql)->paginate('10');
        return view('cargos')->with($lista);
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
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;
            //Se regresa a la ruta anterior con los errores cometidos para ser mostrados en la vista
            return redirect()->back()->withErrors($respuestas['mensaje']);
        } else {
            $respuestas['error'] = false;
            if (Cargo::where('nombre_cargo', $datos['inputNombreCargo'])->exists()) {
                return response()->json(['estado' => false, 'mensaje' => 'El cargo ya existe'], 200);
            } else {
                $cargo = new Cargo();

                $cargo->setNombreCargoAttribute($request->nombre_cargo);
                $cargo->setEstadoAttribute($request->estado_cargo);

                Cargo::create($cargo);

                $listaCargos = Cargo::paginate('10')->orderBy('id_cargo', 'desc');
                $controladores = $request->controladores;

                $tabla = view('modals.grupos.tablaGrupo', ['listaCargos' => $listaCargos, 'controladores' => $controladores])->render();
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
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;
            return redirect()->back()->withErrors($respuestas['mensaje']);
            // dd($validacion->errors());
        } else {
            $respuestas['error'] = false;
            $ajax = Cargo::where('nombre_cargo', $datos['nombre_cargo'])->get();

            if (count($ajax)) {
                return view('alertas.repetido');
            } else {
                $cargo = new Cargo();

                $cargo->setNombreCargoAttribute($request->nombre_cargo);
                $cargo->setEstadoAttribute($request->estado_cargo);

                Cargo::where('nombre_cargo', $datos['nombre_cargo_old'])->update($cargo);

                return view('alertas.modifcarExitoso');
            }
        }
    }
}
