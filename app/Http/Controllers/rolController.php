<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Permiso;
use App\Models\Rol;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RolController extends Controller
{
    public function showRegistrarRol()
    {
        // dd($funciones);
        $funciones = $this->consultarPermisos();
        $array_existencia = array();
        return view('crearRol', compact('funciones', 'array_existencia'));
    }

    public function consultarPermisos()
    {
        $sql = "select fun.display nombre, fun.id_funcion id, con.id_controlador,
        con.displayController controlador from funciones fun, controladores con WHERE con.id_controlador = fun.id_controlador
        ORDER BY fun.id_controlador";

        return DB::select($sql);
    }

    public function registrarRol(Request $request)
    {
        $datos = request()->all();
        //dd($datos);
        // $sql = "INSERT INTO roles VALUES(DEFAULT,request()->all()->inputRol,request()->all()->inputNombreRol,request()->all()->inputEstado)";
        $reglas = [
            'inputNombreRol' => 'required',
            'inputEstadoRol' => 'required',
        ];

        $mensajes = [
            'inputNombreRol.required' => 'Este campo es obligatorio',
            'inputEstadoRol.required' => 'Este campo es obligatorio'
        ];

        $validacion = Validator::make($request, $reglas, $mensajes);

        $respuesta = [];

        if ($validacion->fails()) {
            $respuestas['mensaje'] = $validacion;
            $respuestas['error'] = true;
            return redirect()->back()->withErrors($respuestas['mensaje'])->withInput();
        } else {
            $rol = new Rol();

            $rol->setRolAttribute($request->inputNombreRol);
            $rol->setEstadoRolAttribute($request->inputEstadoRol);

            $registro = Rol::create($rol);

            $sql = log_auditoria::createLog(
                'rol',
                $rol->getRolAttribute(),
                'registro'
            );
            Log::insert($sql);

            $idRol = $registro->id_rol;

            $funciones = $datos['checkFunciones'];

            foreach ($funciones as $funcion) {
                // dd($funcion);
                $sql = "INSERT INTO permisos VALUES(DEFAULT,'" . $idRol . "','" . $funcion . "')";
                $resultado = Permiso::create(['id_rol' => $idRol, 'id_funcion' => $funcion]);
            }

            if ($registro == true && $resultado == true) {
                return redirect()->route('roles.consultar');
            } else {
                echo 'Se produjo un error al registrar';
            }
        }
    }



    public function consultarPermiso($idRol)
    {
        $sql = "SELECT id_permiso, id_funcion FROM permisos WHERE id_rol = $idRol";
        return DB::select($sql);
    }


    public function consultarRol()
    {
        $roles = Rol::all();

        foreach ($roles as $rol) {
            $rol->id_rol = Crypt::encrypt($rol->id_rol);
        }
        return view('consultarRoles', compact('roles'));
    }

    public function editarRol($id)
    {
        $id = Crypt::decrypt($id);
        $permisos = $this->consultarPermiso($id);

        $permisoIds = array();
        foreach ($permisos as $permiso) {
            $permisoIds[] = $permiso->id_funcion;
        }

        $funciones = $this->consultarPermisos();
        $array_existencia = array();

        $sql_rol = "SELECT rol, estado FROM roles WHERE  id_rol = '$id'";
        $rol_data = DB::select($sql_rol);
        $rol_nombre = $rol_data[0]->rol;
        $rol_estado = $rol_data[0]->estado;

        $rol = Rol::findOrFail($id);
        $rol = Crypt::encrypt($rol);

        return view('editarRol', compact('rol', 'rol_nombre', 'rol_estado', 'permisos', 'funciones', 'array_existencia', 'permisoIds'));
    }


    public function actualizarRol($id)
    {
        extract($_POST);
        // dd($_POST);
        $id = Crypt::decrypt($id)->id_rol;

        DB::table('roles')->where('id_rol', $id)->update(["rol" => $rol_nombre, "estado" => $estado]);


        return redirect()->route("roles.consultar");
    }
}
