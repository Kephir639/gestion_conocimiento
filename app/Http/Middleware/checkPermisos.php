<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use function Laravel\Prompts\select;

class checkPermisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $idRol = Auth::user()->idRol;
        // $idRol = 1;
        $sql = "SELECT f.nombre_funcion, f.display_funcion, c.id_controlador, c.nombre_controlador, c.displayController,
        c.display_icon FROM permisos p, funciones f, controladores c WHERE p.id_rol = '$idRol'
        AND p.id_funcion = f.id_funcion AND f.id_controlador = c.id_controlador ORDER BY f.id_controlador";
        $permisos = (object) DB::select($sql);

        $controladores = [];

        foreach ($permisos as $permiso) {
            $contr = $permiso->id_controlador;
            $nombre_contr = $permiso->nombre_controlador;
            $display_contr = $permiso->displayController;
            $icono_contr = $permiso->display_icon;

            if (!isset($controladores[$contr])) {
                $controladores[$contr] = [
                    'nombre_controlador' => $nombre_contr,
                    'display_controlador' => $display_contr,
                    'icono' => $icono_contr,
                    'funciones' => []
                ];
            }

            $controladores[$contr]['funciones'][] = [
                'nombre_funcion' => $permiso->nombre_funcion,
                'display_funcion' => $permiso->display_funcion
            ];
        }
        // dd($controladores);
        $request->merge(['controladores' => $controladores]);

        return $next($request);
    }
}
