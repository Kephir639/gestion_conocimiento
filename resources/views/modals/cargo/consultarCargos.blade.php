@extends('layouts.plantillaIndex')
@section('title', 'Inicio')
@section('content')
    <div class="cuadradoVistas">
        <div class="indexBackground row">
            <div class="backgroundText">
                <h2>Lista de cargos</h2>
                <input type="hidden">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Cargo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cargos as $cargo)
                            <tr>
                                <td>{{ $cargo->nombre_cargo }}</td>
                                @if ($cargo->estado == '1')
                                    <td>Activo</td>
                                @else
                                    <td>Inactivo</td>
                                @endif
                                <td>
                                    <a href="{{ url('/cargos/crearCargo') }}" class="btn btn-primary">Agregar</a>
                                    <a href="{{ url('cargos/editarCargo/' . $cargo->id_cargo) }}"
                                        class="btn btn-warning">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
