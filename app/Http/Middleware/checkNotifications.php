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
        if (Auth::user()->idRol == 1) {
            $notificaciones = User::where('idRol', null)->orderBy('id', 'desc')->count();

            $request->merge(['notificaciones' => $notificaciones]);
        } else {
            $request->merge(['notificaciones' => []]);
        }
        return $next($request);
    }
}
