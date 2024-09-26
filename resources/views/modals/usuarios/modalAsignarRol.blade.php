<div class="modal" id="modalAsignarRol">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Asignar rol</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formModificar">
                    <div class="row mt-3">
                        <!-- Token CSRF -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">

                        <!-- Tabla de información adicional -->
                        <div class="col-md-12 col-sm-12 mt-3">
                            <table class="table table-bordered" id="tablaDetalles">
                                <thead>
                                    <tr>
                                        <th>NOMBRE COMPLETO</th>
                                        <th>ROL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- Nombre completo -->
                                        <td>
                                            <input type="text" class="form-control" id="inputNombreUsuario"
                                                name="nombre_usuario" readonly>
                                        </td>
                                        <!-- Selección de rol -->
                                        <td>
                                            <select class="form-control" id="inputRol" name="idRol" required>
                                                <option value="">Seleccione...</option>
                                                <!-- Opción por defecto -->
                                                @foreach ($roles as $rol)
                                                    <option value="{{ $rol->id_rol }}">{{ $rol->rol }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Botón enviar -->
                        <div class="col-md-12 col-sm-12 mt-3">
                            <button id="btnAsignarRol" type="submit" class="btn btn-success w-100">Asignar</button>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
            <div id="alertasModificar"></div>
        </div>
    </div>
</div>
</div>
