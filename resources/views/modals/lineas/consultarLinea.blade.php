@extends('layouts.plantillaIndex')
@section('title', 'Inicio')
@section('content')
    <div class="cuadradoVistas">
        <div class="indexBackground row">
            <div class="backgroundText">
                <h2>Lista de investigacion</h2>
                <input type="hidden">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Líneas de investigación</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @foreach ($lineas as $linea)
                            <tr>
                                <td>{{ $linea->nombre_linea }}</td>
                                @if ($linea->estado == '1')
                                    <td>Activo</td>
                                @else
                                    <td>Inactivo</td>
                                @endif
                                <td>
                                    <a href="{{ url('/lineas/crearLineas') }}" class="btn btn-primary">Agregar</a>
                                    <a href="{{ url('lineas/editarLineas/' . $linea->id_linea) }}"
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
