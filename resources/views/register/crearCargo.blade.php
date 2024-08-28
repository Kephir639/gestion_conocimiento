@extends('layouts.plantillaIndex')

@section('title', 'Inicio')

@section('content')

    <div class="cuadradoVistas">
        <div class="indexBackground row">
            <div class="backgroundText">
                <h1>Registrar cargo</h1>
                <form method="POST" action="{{ url('cargos/registrarCargos') }}">
                    @csrf
                    <label for="inputCargo">Cargo</label>
                    <select name="inputNombreCargo" id="inputNombreCargo">
                        <option value="Administrativo">Administrativo</option>
                        <option value="Aprendiz">Aprendiz</option>
                        <option value="Auditor">Auditor</option>
                        <option value="Coordinador">Coordinador</option>
                        <option value="Dinamizador SENNOVA">Dinamizador SENNOVA</option>
                        <option value="Instructor">Instructor</option>
                        <option value="Profesional">Profesional</option>
                        <option value="Subdirector">Subdirector</option>
                    </select>
                    <select name="inputEstadoCargo" id="inputEstadoCargo">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
            <div class="backgroundImage"></div>
        </div>
    </div>
@endsection
