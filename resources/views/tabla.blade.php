@extends('layouts.plantillaIndex')



@section('title', 'Tabla')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/plantillaTablas.css') }}">
@endpush

@section('content')
    <div class="cuadradoVistas">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="statsTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Valor</th>
                        <th>Cambio (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Producto A</td>
                        <td>Categoría 1</td>
                        <td>1200</td>
                        <td class="text-success">+10%</td>
                    </tr>
                    <tr>
                        <td>Producto B</td>
                        <td>Categoría 2</td>
                        <td>800</td>
                        <td class="text-danger">-5%</td>
                    </tr>
                    <!-- Más filas -->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right">Total: 2000</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        



    </div>

@endsection
