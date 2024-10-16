<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class log_auditoria extends Controller
{
    public function showLog(Request $request)
    {
        $listaLog = Log::orderBy('id_log', 'desc')->paginate('10');
        $controladores = $request->controladores;

        return view('consultarLog', [
            'listaLog' => $listaLog,
            'controladores' => $controladores
        ]);
    }

    public static function createLog($modulo, $elemento, $accion, $nuevo = "")
    {
        $sql = [
            'accion_realizada' => "'Se " . $accion . " el/la " . $modulo . ": " . $elemento . "'",
            'fecha_realizacion' => Carbon::now(),
            'documento_responsable' => "'" . Auth::user()->identificacion . "'"
        ];


        $sqlAct = [
            'accion_realizada' => "'Se " . $accion . " el/la " . $modulo . ": " . $elemento . " a " . $nuevo . "'",
            'fecha_realizacion' => Carbon::now(),
            'documento_responsable' => "'" . Auth::user()->identificacion . "'"
        ];

        return ($accion === "actualizo") ? $sqlAct : $sql;
    }

    public function consultarAuditoria(Request $request)
    {
        $listaLog = Log::orderBy('id_log', 'desc')->paginate('3');
        $controladores = $request->controladores;
        $notificaciones = $request->notificaciones;


        return view('modals.auditoria.consultarAuditoria', compact('listaLog', 'controladores', 'notificaciones'));
    }
}
