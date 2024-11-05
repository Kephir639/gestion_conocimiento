<div class="modal fade" id="modalVincularPendientes" tabindex="-1" aria-labelledby="vincularPendientesLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="vincularPendientesLabel">Vincular Usuarios</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-bordered">
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

                            @php $n = 1; @endphp
                            @foreach ($integrantes as $clave => $integrante)
                                <tr>
                                    <td>{{ $integrante['nombre'] }}</td>
                                    <td>{{ $integrante['apellido'] }}</td>
                                    <td>{{ $integrante['documento'] }}</td>
                                    <td>{{ $integrante['ficha'] }}</td>
                                    <td>{{ $integrante['programa_formacion'] }}</td>
                                    <!-- Cambio a programa_formacion -->
                                    <td class="text-center">
                                        <button title="Verificar Usuario" class="btn btn-success btn-sm me-1"
                                            onclick="validarUsuario('{{ $clave }}', '{{ $integrante['id_semillero'] }}')">
                                            <i class="fas fa-check-circle">Aceptar</i>
                                        </button>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="rechazarUsuario('{{ $clave }}')">
                                            <i class="fas fa-times-circle"></i> Rechazar
                                        </button>
                                    </td>
                                </tr>
                                @php $n++ @endphp
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-secondary">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
