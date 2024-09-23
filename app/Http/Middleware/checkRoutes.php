<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class checkRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Obtener la ruta actual
        $route = request()->route();

        // Obtener el controlador y la función correspondientes a la ruta
        $ruta = explode('/', $route->uri);

        $funcion = $ruta[2];

        $funcion = DB::table('funciones')->select('id_funcion')->where('nombre_funcion', $funcion)->get();
        $id_funcion = $funcion->pluck('id_funcion');

        // Verificar si el usuario tiene permiso para acceder a la función
        if (! $this->hasPermission($id_funcion[0])) {
            // Redirigir al usuario a la página anterior si no tiene permiso
            return redirect()->back();
        }

        // Permitir que la solicitud continúe si el usuario tiene permiso
        return $next($request);
    }

    private function hasPermission($id_funcion)
    {
        // Obtener el rol del usuario actual
        $rol = Auth::user()->idRol;
        // dd($rol);
        // dd($id_funcion);
        // Verificar si el usuario tiene permiso para acceder a la función
        $permission = DB::table('permisos')
            ->where(['id_funcion' => $id_funcion, 'id_rol' => $rol])
            ->get();

        return ! is_null($permission);
    }
}
