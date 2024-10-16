<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class inicioController extends Controller
{
        public function index(Request $request)
        {
                $controladores = $request->controladores;
                $usuariosPendientes = $request->usuariosPendientes;
                $notificaciones = $request->notificaciones;
                return view('layouts.plantillaIndex', compact('controladores', 'usuariosPendientes', 'notificaciones'));
        }
}
