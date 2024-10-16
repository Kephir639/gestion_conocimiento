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
                            <th id="nombre">ACCION REALIZADA</th>
                            <th>FECHA</th>
                            <th id="acciones">RESPONSABLE</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody_redes">
                        @foreach ($listaLog as $log)
                            <tr>
                                <td>{{ $log->accion_realizada }}</td>
                                <td>{{ $log->fecha_realizacion }}</td>
                                <td>{{ $log->documento_responsable }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="ModalSection"></div>
            </div>
        </div>
    </div>
@endsection
