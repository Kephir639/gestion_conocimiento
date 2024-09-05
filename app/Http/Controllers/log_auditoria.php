<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class log_auditoria extends Controller
{
    public static function createLog($modulo, $elemento, $accion, $nuevo = "")
    {
        $sql = [
            'accion_realizada' => "'Se " . $accion . "el/la " . $modulo . ": " . $elemento . "'",
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
}
