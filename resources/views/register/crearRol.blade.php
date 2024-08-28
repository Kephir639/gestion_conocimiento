@extends('layouts.plantillaIndex')
@section('title', 'Inicio')
@section('content')
    <div class="cuadradoVistas">
        <div class="indexBackground row">
            <div class="backgroundText">
                <h1>Registrar rol</h1>
                <form method="POST" action="{{ url('roles/registrarRol') }}">
                    @csrf
                    <label for="inputRol" class="form-label">Rol</label>
                    <select name="inputNombreRol" id="inputNombreRol">
                        <option value="Administrador">Administrador</option>
                        <option value="Aprendiz">Aprendiz</option>
                        <option value="Auditor">Auditor</option>
                        <option value="Coordinador">Coordinador</option>
                        <option value="Dinamizador SENNOVA">Dinamizador SENNOVA</option>
                        <option value="Instructor investigador">Instructor investigador</option>
                        <option value="Líder de semillero">Líder de semillero</option>
                        <option value="Líder de proyecto">Líder de proyecto</option>
                    </select>
                    <label for="inputEstado" class="form-label">Estado</label>
                    <select name="inputEstadoRol" id="inputEstadoRol">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select><br>
                    <label for="inputPermisos" class="form-label">Permisos</label><br>
                    <div class="row">
                        @foreach ($funciones as $key => $funcion)
                            @if (!in_array($funcion->controlador, $array_existencia))
                                @if ($key != 0)
                    </div>
                    @endif
                    <?php $array_existencia[] = $funcion->controlador; ?>
                    <div class="col-md-6 col-sm-12 text-center">
                        <h3>{{ $funcion->controlador }}</h3>
                        @endif
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="checkFunciones[]" id="inlineCheckbox1"
                                value="{{ $funcion->id }}">{{ $funcion->nombre }}<label></label><br>
                        </div><br>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
            <div class="backgroundImage"></div>
        </div>
    </div>
    </form>
@endsection
