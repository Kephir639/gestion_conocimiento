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
        $route = $request->route();

        // Obtener el controlador y la función correspondientes a la ruta
        $controller = $route->getAction('controller');
        $function = $route->getAction('function');

        $id_function = DB::table('funciones')->where('nombre_funcion', $function)->get();

        // Verificar si el usuario tiene permiso para acceder a la función
        if (! $this->hasPermission($controller, $id_function)) {
            // Redirigir al usuario a la página anterior si no tiene permiso
            return redirect()->back();
        }

        // Permitir que la solicitud continúe si el usuario tiene permiso
        return $next($request);
    }

    private function hasPermission($controller, $id_function)
    {
        // Obtener el rol del usuario actual
        $rol = Auth::user()->idRol;

        // Verificar si el usuario tiene permiso para acceder a la función
        $permission = DB::table('permisos')
            ->where('id_funcion', $id_function)
            ->where('id_rol', $rol)
            ->first();

        return ! is_null($permission);
    }
}
