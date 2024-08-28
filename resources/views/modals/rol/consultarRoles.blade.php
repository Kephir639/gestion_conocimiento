@extends('layouts.plantillaIndex')
@section('title', 'Inicio')
@section('content')
    <div class="cuadradoVistas">
        <div class="indexBackground row">
            <div class="backgroundText">
                <h2>Lista de roles</h2>
                <input type="hidden">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Rol</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $rol)
                            <tr>

                                <td>{{ $rol->rol }}</td>

                                @if ($rol->estado == '1')
                                    <td>Activo</td>
                                @else
                                    <td>Inactivo</td>
                                @endif
                                <td>
                                    <a href="{{ url('roles/crearRol') }}" class="btn btn-primary">Agregar</a>

                                    <a href="{{ url('roles/editarRol/' . $rol->id_rol) }}"
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
