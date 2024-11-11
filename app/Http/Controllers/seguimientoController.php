<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class seguimientoController extends Controller
{
    #Inicio consultas
    public function showModalSeguimiento(Request $request)
    {
        $id_p_investigacion = DB::table('proyectos_investigacion')->select('id_p_investigacion')->where('codigo_sigp', $request->codigo_sigp)->get();
        $sql = DB::table('respuesta_seguimiento as rs')
            ->join('investigacion_has_users as ihu', 'rs.id_ihu', '=', 'ihu.id_ihu')
            ->join('respuesta_seguimiento_detalle as rd', 'rs.id_respuesta', '=', 'rd.id_respuesta')
            ->where('ihu.id_p_investigacion', $id_p_investigacion)
            ->get();
        // $sql = "SELECT * FROM respuesta_seguimiento rs, investigacion_has_users ihu,respuesta_seguimiento_detalle rd
        //         WHERE rs.id_respuesta = rd.id_respuesta 
        //         AND rs.id_ihu = ihu.id_ihu";
        $preguntas = DB::select($sql);

        return view('modals.proyectos.seguimientoProyecto', ['preguntas' => $preguntas]);
    }
    #Fin consultas

    #Inicio peticiones
    public function seguimientoProyecto(Request $request)
    {
        $reglas = [
            'pregunta1' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'pregunta2' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'pregunta3' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'pregunta4' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'pregunta5' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'pregunta6' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'pregunta7' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'pregunta8' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'pregunta9' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'pregunta10' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',
            'pregunta11' => 'required|regex:/^[a-zA-Z0-9 áéíóúÁÉÍÓÚ]+$/',

        ];
        $mensajes = [
            'pregunta1.required' => 'Esta pregunta es obligatoria',
            'pregunta2.required' => 'Esta pregunta es obligatoria',
            'pregunta3.required' => 'Esta pregunta es obligatoria',
            'pregunta4.required' => 'Esta pregunta es obligatoria',
            'pregunta5.required' => 'Esta pregunta es obligatoria',
            'pregunta6.required' => 'Esta pregunta es obligatoria',
            'pregunta7.required' => 'Esta pregunta es obligatoria',
            'pregunta8.required' => 'Esta pregunta es obligatoria',
            'pregunta9.required' => 'Esta pregunta es obligatoria',
            'pregunta10.required' => 'Esta pregunta es obligatoria',
            'pregunta11.required' => 'Esta pregunta es obligatoria',
            'pregunta1.regex' => 'Este campo solo puede contener letras y numeros',
            'pregunta2.regex' => 'Este campo solo puede contener letras y numeros',
            'pregunta3.regex' => 'Este campo solo puede contener letras y numeros',
            'pregunta4.regex' => 'Este campo solo puede contener letras y numeros',
            'pregunta5.regex' => 'Este campo solo puede contener letras y numeros',
            'pregunta6.regex' => 'Este campo solo puede contener letras y numeros',
            'pregunta7.regex' => 'Este campo solo puede contener letras y numeros',
            'pregunta8.regex' => 'Este campo solo puede contener letras y numeros',
            'pregunta9.regex' => 'Este campo solo puede contener letras y numeros',
            'pregunta10.regex' => 'Este campo solo puede contener letras y numeros',
            'pregunta11.regex' => 'Este campo solo puede contener letras y numeros',

        ];

        $datos = $request->all();
        $validacion = Validator::make($datos, $reglas, $mensajes);

        if ($validacion->fails()) {
            return response()->json(['errors' => $validacion->errors()], 422);
        } else {
            /*Codigo para comprobrar que la respuesta que se ingrese no exista en la base de datos,
            en este caso lo que se puede hacer en el apartado de la vista es que las respuestas se
            carguen en los inputs y que ademas en el ID de cada input vaya el id de las respuestas
            de manera que en el controlador se compruebe si la respuesta que está vinculada a esa
            pregunta ya fue respondida por el usuario, es decir, necesitamos hacer una consulta
            en la cual con el ID del usuario comprobemos si el numero de la pregunta que está llegando
            ya fue respondida por el mismo y devolver una respuesta rechazando la peticion, ya que se
            realizara en ajax, seria devolver un alerta(vista de alerta) informandole al usuario que 
            dicha pregunta ya fue respondida.
            
            Una idea a la hora de hacer la vista es que en la pregunta que se este respondiendo
            haya un boton, el cual se encarga de realizar la peticion por ajax para contestar la pregunta,
            y que al ser contestada la pregunta se cierre la pregunta y se elimine boton, y al abrir la 
            siguiente pregunta se agrege el boton de nuevo. Esto implica realizar un filtro para que solo se
            pueda contestar una pregunta por solicitud.*/
        }
    }
    #Fin peticiones

    #Funciones individuales

}
