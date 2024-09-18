<?php

namespace App\Http\Controllers;

use App\Models\proyectosInvestigacion;
use Illuminate\Http\Request;

class proyectosInvestigacionController extends Controller
{

    public function showProyectosInvestigativos(Request $request)
    {
        $listaProyectos = proyectosInvestigacion::orderBy('id_proyecto_investigacion', 'desc')->paginate('10');
        $controladores = $request->controladores;

        return view('modals.proyectos.investigacion.consultarProyectos', [
            'listaProyectos' => $listaProyectos,
            'controladores' => $controladores
        ]);
    }

    public function showModalRegistrar(Request $request)
    {
        return view('modals.proyectos.investigacion.crearProyectos');
    }

    public function showModalActualizar(Request $request)
    {
        return view('modals.proyectos.investigacion.modificarProyectos');
    }
}
