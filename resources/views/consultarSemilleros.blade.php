@extends('layouts.plantillaIndex')

@section('title', 'Consultar Semilleros')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/plantillaTablas.css') }}">
@endpush

@section('content')
<div class="cuadradoVistas mt-4">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="tablaPrincipal">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Valor</th>
                    <th>Acciones</th>
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

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ url('js/semilleros.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable_semilleros').DataTable({
                "pagingType": "full_numbers",
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "responsive": true
            });
        });
    </script>
@endsection
