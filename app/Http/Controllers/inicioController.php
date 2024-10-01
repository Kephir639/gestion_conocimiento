<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class inicioController extends Controller
{
    public function index(Request $request)
    {
        $controladores = $request->controladores;
        $usuariosPendientes = $request->ususariosPendientes;


        return view('index', compact('controladores', 'usuariosPendientes'));
    }
}
