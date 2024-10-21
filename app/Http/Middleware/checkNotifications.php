<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::user());
        if (Auth::user()->idRol == 1) {
            $notificaciones = User::where('idRol', null)->orderBy('id', 'desc')->count();

            // dd("a");
            $request->merge(['notificaciones' => $notificaciones]);
        } else {
            $request->merge(['notificaciones' => []]);
        }
        // (Auth::user()->id_rol == 1) ? $request->merge(['notificaciones', User::where('id_rol', null)->orderBy('id', 'desc')->get()]) : $request->merge(['usuarioPendientes', []]);
        // dd($notificaciones);
        return $next($request);
    }
}
