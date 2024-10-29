<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class seguimientoController extends Controller
{
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
    public function showModalSeguimiento(Request $request)
    {
        $id_p_investigacion = DB::table('proyectos_investigacion')->select('id_p_investigacion')->where('codigo_sigp', $request->codigo_sigp)->get();
        $sql = DB::table('respuesta_seguimiento as rs')
            ->join('investigacion_has_users as ihu', 'rs.id_ihu', '=', 'ihu.id_ihu')
            ->join('respuesta_seguimiento_detalle as rd', 'rs.id_respuesta', '=', 'rd.id_respuesta')
            ->where('ihu.id_p_investigacion', $id_p_investigacion)
            ->get();
        dd($sql);
        // $sql = "SELECT * FROM respuesta_seguimiento rs, investigacion_has_users ihu,respuesta_seguimiento_detalle rd
        //         WHERE rs.id_respuesta = rd.id_respuesta 
        //         AND rs.id_ihu = ihu.id_ihu";
        $preguntas = DB::select($sql);

        return view('modals.proyectos.seguimientoProyecto', ['preguntas' => $preguntas]);
    }
}
