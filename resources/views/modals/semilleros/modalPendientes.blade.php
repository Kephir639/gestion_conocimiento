<div class="modal" id="modalVincularPendientes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Vincular Usuarios</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>APELLIDO</th>
                            <th>DOCUMENTO</th>
                            <th>FICHA</th>
                            <th>PROGRAMA</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="tablebody_pendientes">
                        @foreach ($integrantes as $integrante)
                            <tr>
                                <td><input type="checkbox" name="aceptados[]"></td>
                                <td>{{ $integrante->name }}</td>
                                <td>{{ $integrante->apellidos }}</td>
                                <td>{{ $integrante->documento }}</td>
                                <td>{{ $integrante->ficha }}</td>
                                <td>{{ $integrante->programa }}</td>
                                <td>
                                    @foreach ($controladores as $controlador)
                                        @if ($controlador['nombre_controlador'] == 'semilleros')
                                            @foreach ($controlador['funciones'] as $func)
                                                @if ($func['nombre_funcion'] == 'verificar_usuarios')
                                                    <button title="Verificar Usuario" class="btn iconoAceptar p-0"><svg
                                                            class="iconoM" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zM8.999 17H7v-1.999l5.53-5.522 1.999 1.999L8.999 17zm6.473-6.465-1.999-1.999 1.524-1.523 1.999 1.999-1.524 1.523z">
                                                            </path>
                                                        </svg></button>
                                                    <button class="btn btn-danger btnRechazar">Rechazar</button>
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
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
