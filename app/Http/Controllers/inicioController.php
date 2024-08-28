<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inicioController extends Controller
{
    public function index(Request $request)
    {
        $controladores = $request->controladores;
        return view('index', compact('controladores'));
    }
}
