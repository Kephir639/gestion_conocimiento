@extends('layouts.plantillaIndex')

@section('title', 'Centros Formativos')
@push('styles')
    <link rel="stylesheet" href="{{ url('css/centros.css') }}">
@endpush
@section('content')
    <div class="container mt-2">
        <div class="row p-3">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table class="table">
                    <thead class="tableHeadre">
                        <tr class="tituloTabla">
                            <th>CODIGO</th>
                            <th id="nombre">NOMBRE</th>
                            <th>ESTADO</th>
                            <th id="acciones">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody_centros">
                        @foreach ($listaCentros as $centros)
                            <tr>
                                <td>{{ $centros->codigo_centro }}</td>
                                <td>{{ $centros->nombre_centro }}</td>
                                <td>
                                    @if ($centros->estado_centro == 1)
                                        Activo
                                    @elseif ($centros->estado_centro == 0)
                                        Inactivo
                                    @endif
                                </td>
                                <td>
                                    @foreach ($controladores as $controlador)
                                        @if ($controlador['nombre_controlador'] == 'centros')
                                            @foreach ($controlador['funciones'] as $func)
                                                @if ($func['nombre_funcion'] == 'modificar_centro')
                                                    <button title="Modificar Centro" class="btn iconoModificar"><svg
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
                <a href="#" title="Registrar Red" id="BtnRegistrarRed" class="btn p-0"><svg
                        xmlns="http://www.w3.org/2000/svg" class="iconoRegistrar" viewBox="0 0 24 24">
                        <path
                            d="M5 21h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm2-10h4V7h2v4h4v2h-4v4h-2v-4H7v-2z">
                        </path>
                    </svg></a>
                <div id="ModalSection">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('js/centros.js') }}"></script>
@endsection
