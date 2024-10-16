<div class="modal fade" id="modalVincularPendientes" tabindex="-1" aria-labelledby="vincularPendientesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="vincularPendientesLabel">Vincular Usuarios</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>DOCUMENTO</th>
                                <th>FICHA</th>
                                <th>PROGRAMA</th>
                                <th class="text-center">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody class="tablebody_pendientes">
                            {{-- Ejemplo de datos --}}
                            {{-- @foreach ($integrantes as $integrante)
                                <tr>
                                    <td>{{ $integrante->name }}</td>
                                    <td>{{ $integrante->apellidos }}</td>
                                    <td>{{ $integrante->documento }}</td>
                                    <td>{{ $integrante->ficha }}</td>
                                    <td>{{ $integrante->programa }}</td>
                                    <td class="text-center">
                                        <button title="Verificar Usuario" class="btn btn-success btn-sm me-1">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm btnRechazar">
                                            <i class="fas fa-times-circle"></i> Rechazar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

