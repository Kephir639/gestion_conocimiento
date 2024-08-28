@extends('layouts.plantillaIndex')

@section('title', 'Grupos de Investigacion')
@push('styles')
<<<<<<< HEAD
=======
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.0/css/dataTables.dataTables.min.css">
>>>>>>> 223875880eee132c6a0675e6eaa126f68479e7f9
    <link rel="stylesheet" href="{{ url('css/grupos.css') }}">
@endpush
@section('content')
    <div class="container mt-2">
        <div class="row p-3">
<<<<<<< HEAD
            <div id="divTabla" class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table class="table tablaGrupo">
=======
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table class="table tablaGrupos">
>>>>>>> 223875880eee132c6a0675e6eaa126f68479e7f9
                    <thead class="tableHeadre">
                        <tr class="tituloTabla">
                            <th id="nombre">NOMBRE</th>
                            <th>ESTADO</th>
                            <th id="acciones">ACCIONES</th>
                        </tr>
                    </thead>
<<<<<<< HEAD
                    <tbody id="tablebody_grupos">
                        @foreach ($listaGrupos as $grupos)
                            <tr>
                                <td>{{ $grupos->nombre_grupo }}</td>
                                <td>
                                    @if ($grupos->estado_gurpo == 1)
                                        Activo
                                    @elseif ($grupos->estado_grupo == 0)
=======
                    <tbody id="tablebody_redes">
                        @foreach ($listaGrupos as $grupos)
                            <tr>
                                <td>{{ $grupos->nombre_grp }}</td>
                                <td>
                                    @if ($grupos->estado_grp == 1)
                                        Activo
                                    @elseif ($grupos->estado_grp == 0)
>>>>>>> 223875880eee132c6a0675e6eaa126f68479e7f9
                                        Inactivo
                                    @endif
                                </td>
                                <td>
                                    @foreach ($controladores as $controlador)
                                        @if ($controlador['nombre_controlador'] == 'grupos')
                                            @foreach ($controlador['funciones'] as $func)
                                                @if ($func['nombre_funcion'] == 'modificar_grupo')
                                                    <button title="Modificar Grupo" class="btn iconoModificar p-0"><svg
<<<<<<< HEAD
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
=======
                                                            class="iconoM" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24">
>>>>>>> 223875880eee132c6a0675e6eaa126f68479e7f9
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
<<<<<<< HEAD
            </div>
            @foreach ($controladores as $controlador)
                @if ($controlador['nombre_controlador'] == 'grupos')
                    @foreach ($controlador['funciones'] as $func)
                        @if ($func['nombre_funcion'] == 'modificar_grupo')
                            <button title="Registrar Grupo" id="BtnRegistrarGrupo" class="btn iconoRegistrar p-0"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M5 21h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm2-10h4V7h2v4h4v2h-4v4h-2v-4H7v-2z">
                                    </path>
                                </svg></button>
                        @endif
                    @endforeach
                @endif
            @endforeach
            <div id="ModalSection">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('js/gruposInvestigacion.js') }}"></script>
=======
                @foreach ($controladores as $controlador)
                    @if ($controlador['nombre_controlador'] == 'grupos')
                        @foreach ($controlador['funciones'] as $func)
                            @if ($func['nombre_funcion'] == 'crear_grupo')
                                <button href="#" title="Registrar Grupo" id="BtnRegistrarRed" class="btn p-0"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="iconoRegistrar" viewBox="0 0 24 24">
                                        <path
                                            d="M5 21h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm2-10h4V7h2v4h4v2h-4v4h-2v-4H7v-2z">
                                        </path>
                                    </svg></button>
                            @endif
                        @endforeach
                    @endif
                @endforeach

            </div>
        </div>
    </div>
    <div id="ModalSection">
    </div>
@endsection

@section('scripts')
    <script src="{{ url('js/redesInvestigacion.js') }}"></script>
>>>>>>> 223875880eee132c6a0675e6eaa126f68479e7f9
@endsection
