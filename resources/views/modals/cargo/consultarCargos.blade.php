@extends('layouts.plantillaIndex')

@section('title', 'Cargos')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ url('css/consultaCargo.css') }}">
    @endpush

    <div class="container mt-2">
        <div class="row p-3">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table class="table tablaCargos">
                    <thead class="tableHeadre">
                        <tr class="tituloTabla">
                            <th id="nombre">NOMBRE</th>
                            <th>ESTADO</th>
                            <th id="acciones">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody_cargos">
                        @foreach ($cargos as $cargo)
                            <tr>
                                <td>{{ $cargo->nombre_cargo }}</td>
                                <td>
                                    @if ($cargo->estado_cargo == 1)
                                        Activo
                                    @elseif ($cargo->estado_cargo == 0)
                                        Inactivo
                                    @endif
                                </td>
                                <td>
                                    @foreach ($controladores as $controlador)
                                        @if ($controlador['nombre_controlador'] == 'cargos')
                                            @foreach ($controlador['funciones'] as $func)
                                                @if ($func['nombre_funcion'] == 'modificar_cargo')
                                                    <button title="Modificar cargo" class="btn btnEditarCargo p-0"></button>
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
                @if ($controlador['nombre_controlador'] == 'cargos')
                    @foreach ($controlador['funciones'] as $func)
                        @if ($func['nombre_funcion'] == 'modificar_cargo')
                            <button title="Registrar Cargo" id="BtnRegistrarCargo" class="btn iconoRegistrar p-0"></button>
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
    <script src="{{ url('js/cargo.js') }}"></script>
@endsection
