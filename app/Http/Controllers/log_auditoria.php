<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class log_auditoria extends Controller
{
    public static function createLog($modulo, $elemento, $accion, $nuevo = "")
    {
        $sql = "INSERT INTO log_auditoria
                ('accion_realizada', 'fecha_realizacion', 'nombre_responsable', 'documento_responsable')
                VALUES ('Se" . $accion . "el/la " . $modulo . ": " . $elemento . "','" . Carbon::now() . "',
                '" . Auth::user()->name . "','" . Auth::user()->identificacion . "')";

        $sqlAct = "INSERT INTO log_auditoria
                ('accion_realizada', 'fecha_realizacion', 'nombre_responsable', 'documento_responsable')
                VALUES ('Se" . $accion . "el/la " . $modulo . ": " . $elemento . " a " . $nuevo . "','" . Carbon::now() . "',
                '" . Auth::user()->name . "','" . Auth::user()->identificacion . "')";

        return ($modulo === "actualizo") ? $sqlAct : $sql;
    }
}
