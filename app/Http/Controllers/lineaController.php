<?php

namespace App\Http\Controllers;

use App\Models\LineaInvestigacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class lineaController extends Controller
{
    public function consultarLineas()
    {
        $lineas = LineaInvestigacion::all();

        foreach ($lineas as $linea) {
            $linea->id_linea = Crypt::encrypt($linea->id_linea);
        }

        return view('consultarLinea', compact('lineas'));
    }

    public function showregistrarLineas()
    {
        return view('crearLinea');
    }

    public function registrarLinea()
    {

        $datos = request()->all();

        $registroLineas = LineaInvestigacion::create([
            'nombre_linea' => $datos['inputNombreLinea'], 'estado' => $datos['inputEstadoLinea']
        ]);

        if ($registroLineas) {
            return redirect()->route('linea.consultar')->with('Linea registrada exitosamente');
        } else {
            return back()->with('error', 'Error al registrar la linea.');
        }
    }
    public function editarLinea($id)
    {
        $id = Crypt::decrypt($id);
        $sql_linea = "SELECT nombre_linea,estado FROM lineas_investigacion WHERE id_linea ='$id'";
        $linea_data = DB::select($sql_linea);
        $linea_nombre = $linea_data[0]->nombre_linea;
        $linea_estado = $linea_data[0]->estado;
        // dd($linea_data);

        $lineas = LineaInvestigacion::findorFail($id);
        $lineas = Crypt::encrypt($lineas);

        return view('editarLinea', compact('lineas', 'linea_nombre', 'linea_estado'));
    }

    public function actualizarLinea($id)
    {
        extract($_POST);
        $id = Crypt::decrypt($id)->id_linea;
        DB::table('lineas_investigacion')->where('id_linea', $id)->update(["nombre_linea" => $linea_nombre, "estado" => $estado]);

        return redirect()->route('linea.consultar');
    }
}
