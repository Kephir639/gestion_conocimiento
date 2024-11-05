@extends('layouts.plantillaIndex')

@section('title', 'Redes de Investigacion')
@push('styles')
    <link rel="stylesheet" href="{{ url('css/redes.css') }}">
    <link rel="stylesheet" href="{{ url('css/botonesConsultar.css') }}">
@endpush
@section('content')
    <div class="container mt-2">
        <div class="row p-3">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table id="datatable_redes" class="table tablaRed">
                    <thead class="tableHeadre">
                        <tr class="tituloTabla">
                            <th id="nombre">NOMBRE</th>
                            <th>ESTADO</th>
                            <th id="acciones">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody_redes">
                        @foreach ($listaRedes as $redes)
                            <tr>
                                <td>{{ $redes->nombre_red }}</td>
                                <td>
                                    @if ($redes->estado_red == 1)
                                        Activo
                                    @elseif ($redes->estado_red == 0)
                                        Inactivo
                                    @endif
                                </td>
                                <td>
                                    @foreach ($controladores as $controlador)
                                        @if ($controlador['nombre_controlador'] == 'redes')
                                            @foreach ($controlador['funciones'] as $func)
                                                @if ($func['nombre_funcion'] == 'actualizar_redes')
                                                    <button title="Modificar Red" class="btn iconoModificar p-0"><svg
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
                @foreach ($controladores as $controlador)
                    @if ($controlador['nombre_controlador'] == 'redes')
                        @foreach ($controlador['funciones'] as $func)
                            @if ($func['nombre_funcion'] == 'crear_redes')
                                <button href="#" title="Registrar Red" id="BtnModalRegistrarRed" class="btn p-0"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="iconoRegistrar" width="36"
                                        class="" viewBox="0 0 24 24">
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
        <div class="col-12">
            <nav>
                <ul class="pagination justify-content-center">
                    {{ $listaRedes->links('pagination::bootstrap-5') }}
                </ul>
            </nav>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ url('js/redesInvestigacion.js') }}"></script>
@endpush
