<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\ProyectoFormativo;

class ProyectoFormativoController extends Controller
{

    #constantes del controlador

    # inicio consultas
    public function showProyectoFormativo(Request $request)
    {
        $controladores = $request->controladores;
        $listaProyectosFormativos = array();
        $compact = ['controladores', 'listaProyectosFormativos'];
        return view('modals.proyectos.formativo.consultarProyectoFormativo', compact($compact));
    }

    public function showModalRegistrar(Request $request)
    {
        $controladores = $request->controladores;
        $compact = ['controladores'];
        return view('modals.proyectos.formativo.crearProyectoFormativo', compact($compact));
    }

    # fin consultas

    # inicio peticiones

    # fin peticiones

    #funciones individuales

}
