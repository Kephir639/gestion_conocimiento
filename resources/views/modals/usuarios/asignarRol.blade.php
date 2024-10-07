@extends('layouts.plantillaIndex')

@section('title', 'Asignar rol')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ url('css/asignarRol.css') }}">
    @endpush
    <h2 class="text-center">Asignación de roles</h2>


    <div class="container mt-2">
        <div class="row p-3">
            <div class="table-responsive">
                @if ($usuariosPendientes->isEmpty()) <!-- Verifica si no hay usuarios -->
                    <div class="alert alert-success text-center" role="alert">
                        No hay usuarios por asignar.
                    </div>
                @else
                    @foreach ($controladores as $controlador)
                        @if ($controlador['nombre_controlador'] == 'usuarios')
                            @foreach ($controlador['funciones'] as $func)
                                @if ($func['nombre_funcion'] == 'asignar_rol')
                                    <button title="Asignar rol" class="btn btnAsignarTodo">
                                        <svg class="iconoM" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                            width="20" height="25">
                                            <path
                                                d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                                        </svg>
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    <table class="table tablaUsuariosPendientes mt-3 mb-3">
                        <thead class="tableHead">
                            <tr class="tituloTabla">
                                <th id="nombre">NOMBRE</th>
                                <th id="apellido">APELLIDO</th>
                                <th id="apellido">TIPO DOC</th>
                                <th id="Documento">DOCUMENTO</th>
                                <th id="Email">EMAIL</th>
                                <th id="Telefono">TELEFONO</th>
                                <th id="">ESTADO</th>
                                <th><input type="checkbox" id="selectAll"></th>
                            </tr>
                        </thead>
                        <tbody id="tablebody_usuarios">
                            @foreach ($usuariosPendientes as $usu)
                                <tr>
                                    <td>{{ $usu->name }}</td>
                                    <td>{{ $usu->apellidos }}</td>
                                    <td>{{ $usu->tipo_documento }}</td>
                                    <td>{{ $usu->identificacion }}</td>
                                    <td>{{ $usu->email }}</td>
                                    <td>{{ $usu->celular }}</td>
                                    <td>{{ $usu->estado_usu == 1 ? 'ACTIVO' : 'INACTIVO' }}</td>
                                    <td><input type="checkbox" name="userCheckbox[]" class="userCheckbox"
                                            value="{{ $usu->identificacion }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <div id="ModalSection"></div>
            </div>
        </div>
        <div class="col-12">
            <nav>
                <ul class="pagination justify-content-center">
                    {{ $usuariosPendientes->links('pagination::bootstrap-5') }}
                </ul>
            </nav>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ url('js/asignarRol.js') }}"></script>
@endpush
