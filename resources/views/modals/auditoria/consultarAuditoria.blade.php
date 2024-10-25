@extends('layouts.plantillaIndex')

@section('title', 'Auditoria')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ url('css/log.css') }}">
    @endpush

    <div class="container mt-2">
        <div class="row p-3">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <table class="table tablaAuditorias">
                    <thead class="tableHeadre">
                        <tr class="tituloTabla">
                            <th id="nombre">ACCION REALIZADA</th>
                            <th>FECHA DE REALIZACIÓN</th>
                            <th id="acciones">DOCUMENTO RESPONSABLE</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody_auditoria">
                        @foreach ($listaLog as $auditoria)
                            <tr>
                                <td>{{ $auditoria->accion_realizada }}</td>
                                <td>{{ $auditoria->fecha_realizacion }}</td>
                                <td>{{ $auditoria->documento_responsable }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12">
            <nav>
                <ul class="pagination justify-content-center">
                    {{ $listaLog->links('pagination::bootstrap-5') }}
                </ul>
            </nav>
        </div>
    </div>
@endsection
