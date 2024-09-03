<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inicioController extends Controller
{
    public function index(Request $request)
    {
        $controladores = $request->controladores;
        $usuariosPendientes = $request->ususariosPendientes;
        return view('index', compact('controladores', 'usuariosPendientes'));
    }
}
