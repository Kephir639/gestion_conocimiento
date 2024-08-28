<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Rol;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class cargoController extends Controller
{
    public function consultarCargo()
    {
        $cargos = Cargo::all()->paginate('10');
        foreach ($cargos as $cargo) {
            $cargo->id_cargo = Crypt::encrypt($cargo->id_cargo);
        }
        return view('consultarCargos', compact('cargos'));
    }

    public function showregistrarCargo()
    {
        return view('crearCargo');
    }

    public function registrarCargo()
    {
        $datos = request()->all();

        $registroCargo = Cargo::create(['nombre_cargo' => $datos['inputNombreCargo'], 'estado' => $datos['inputEstadoCargo']]);

        if ($registroCargo) {
            return redirect()->route('cargos.consultar')->with('success', 'Cargo registrado exitosamente.');
        } else {
            return back()->with('error', 'Error al registrar el cargo.');
        }
    }
    public function editarCargo($id)
    {
        $id = Crypt::decrypt($id);
        $sql_cargo = "SELECT nombre_cargo,estado FROM cargos WHERE id_cargo ='$id'";
        $cargo_data = DB::select($sql_cargo);
        $cargo_nombre = $cargo_data[0]->nombre_cargo;
        $cargo_estado = $cargo_data[0]->estado;


        $cargo = Cargo::findorFail($id);
        $cargo = Crypt::encrypt($cargo);
        // dd($cargo_data);

        return view('editarCargo', compact('cargo', 'cargo_nombre', 'cargo_estado'));
    }
    public function actualizarCargo($id)
    {
        extract($_POST);
        // dd($_POST);

        $id = Crypt::decrypt($id)->id_cargo;
        DB::table('cargos')->where('id_cargo', $id)->update(["nombre_cargo" => $cargo_nombre, "estado" => $estado]);
        return redirect()->route('cargos.consultar');
    }
}
