@extends('layouts.plantillaIndex')

@section('title', 'Asignar rol')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ url('css/asignarRol.css') }}">
    @endpush

    <div class="container mt-2">
        <div class="row p-3">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table class="table tablaUsuariosPendientes">
                    <thead class="tableHeadre">
                        <tr class="tituloTabla">
                            <th id="nombre">NOMBRE</th>
                            <th id="apellido">APELLIDO</th>
                            <th id="Documento">DOCUMENTO</th>
                            <th id="Email">EMAIL</th>
                            <th id="Telefono">Telefono</th>
                            <th id="acciones">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody_usuarios">
                        @foreach ($usuariosPendientes as $usu)
                            <tr>
                                <td>{{ $usu->name }}</td>
                                <td>{{ $usu->apellidos }}</td>
                                <td>{{ $usu->identificacion }}</td>
                                <td>{{ $usu->email }}</td>
                                <td>{{ $usu->celular }}</td>
                                <td>
                                    @foreach ($controladores as $controlador)
                                        @if ($controlador['nombre_controlador'] == 'usuarios')
                                            @foreach ($controlador['funciones'] as $func)
                                                @if ($func['nombre_funcion'] == 'asignar_rol')
                                                    <button title="Asignar rol" class="btn iconoAsignar p-0">
                                                        <svg class="iconoM" width="34" height="34"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                            <path
                                                                d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    <svg class="iconoM" width="34" height="34" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512">
                                        <path
                                            d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm88 200l144 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-144 0c-13.3 0-24-10.7-24-24s10.7-24 24-24z" />
                                    </svg>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('js/asignarRol.js') }}"></script>
@endsection
