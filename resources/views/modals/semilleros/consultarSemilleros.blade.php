@extends('layouts.plantillaIndex')
@section('title', 'Semilleros de investigacion')
@push('styles')
    <link rel="stylesheet" href="{{ url('css/botonesConsultar.css') }}">
@endpush
@section('content')
    <div class="container mt-2">
        <div class="row p-3">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table class="table">
                    <thead class="tableHeadre">
                        <tr class="tituloTabla">
                            <th>INICIALES</th>
                            <th>NOMBRE</th>
                            <th>LIDER</th>
                            <th>FECHA CREACION</th>
                            <th>ESTADO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody_lineas">
                        @foreach ($listaSemilleros as $semillero)
                            <tr>
                                <td>{{ $semillero->iniciales_semillero }}</td>
                                <td>{{ $semillero->nombre_semillero }}</td>
                                <td>{{ $semillero->lider_semillero }}</td>
                                <td>{{ $semillero->fecha_creacion }}</td>
                                <td>
                                    @if ($semillero->estado_gurpo == 1)
                                        Activo
                                    @elseif ($semillero->estado_grupo == 0)
                                        Inactivo
                                    @endif
                                </td>
                                <td>
                                    @foreach ($controladores as $controlador)
                                        @if ($controlador['nombre_controlador'] == 'semilleros')
                                            @foreach ($controlador['funciones'] as $func)
                                                @if ($func['nombre_funcion'] == 'consultar_semillero')
                                                    <button title="Ver semillero" class="btn iconoModificar p-0"><svg
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
                                    @foreach ($controladores as $controlador)
                                        @if ($controlador['nombre_controlador'] == 'semilleros')
                                            @foreach ($controlador['funciones'] as $func)
                                                @if ($func['nombre_funcion'] == 'modificar_semillero')
                                                    <button title="Modificar semillero" class="btn iconoModificar p-0"><svg
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
                                    @foreach ($controladores as $controlador)
                                        @if ($controlador['nombre_controlador'] == 'semilleros')
                                            @foreach ($controlador['funciones'] as $func)
                                                @if ($func['nombre_funcion'] == 'validar_integrante')
                                                    <button title="Validar integrantes" class="btn iconoModificar p-0"><svg
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
                @if ($controlador['nombre_controlador'] == 'semilleros')
                    @foreach ($controlador['funciones'] as $func)
                        @if ($func['nombre_funcion'] == 'crear_semilleros')
                            <button title="Registrar Semillero" id="BtnRegistrarLinea" class="btn iconoRegistrar p-0"><svg
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
    </div>
@endsection
@section('scripts')
    <script src="{{ url('js/lineasInvestigacion.js') }}"></script>
@endsection
