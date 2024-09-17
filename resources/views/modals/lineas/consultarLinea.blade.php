@extends('layouts.plantillaIndex')
@section('title', 'Lineas de invesitigacion')
@push('styles')
    <link rel="stylesheet" href="{{ url('css/botonesConsultar.css') }}">
    <link rel="stylesheet" href="{{ url('css/lineas.css') }}">
@endpush
@section('content')
    <div class="container mt-2">
        <div class="row p-3">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table class="table">
                    <thead class="tableHeadre">
                        <tr class="tituloTabla">
                            <th id="nombre">NOMBRE</th>
                            <th>ESTADO</th>
                            <th id="acciones">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody_lineas">
                        @foreach ($listaLineas as $lineas)
                            <tr>
                                <td>{{ $lineas->nombre_linea }}</td>
                                <td>
                                    @if ($lineas->estado_linea == 1)
                                        Activo
                                    @elseif ($lineas->estado_linea == 0)
                                        Inactivo
                                    @endif
                                </td>
                                <td>
                                    @foreach ($controladores as $controlador)
                                        @if ($controlador['nombre_controlador'] == 'lineas')
                                            @foreach ($controlador['funciones'] as $func)
                                                @if ($func['nombre_funcion'] == 'modificar_linea')
                                                
                                                    <button title="Modificar Linea" class="btn iconoModificar p-0"><svg
                                                            class="iconoM" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zM8.999 17H7v-1.999l5.53-5.522 1.999 1.999L8.999 17zm6.473-6.465-1.999-1.999 1.524-1.523 1.999 1.999-1.524 1.523z">
                                                            </path>
                                                        </svg></button>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @foreach ($controladores as $controlador)
                @if ($controlador['nombre_controlador'] == 'lineas')
                    @foreach ($controlador['funciones'] as $func)
                        @if ($func['nombre_funcion'] == 'crear_linea')
                            <button title="Registrar Lineas" id="BtnRegistrarLinea" class="btn iconoRegistrar p-0"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M5 21h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm2-10h4V7h2v4h4v2h-4v4h-2v-4H7v-2z">
                                    </path>
                                </svg></button>
                        @endif
                    @endforeach
                @endif
            @endforeach
            <div id="ModalSection"></div>
        </div>
        <div class="col-12">
            <nav>
                <ul class="pagination justify-content-center">
                    {{ $listaLineas->links('pagination::bootstrap-5') }}
                </ul>
            </nav>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('js/lineasInvestigacion.js') }}"></script>
@endsection
