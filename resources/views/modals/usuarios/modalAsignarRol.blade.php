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
                                                name="nombre_usuario" readonly required>
                                        </td>
                                        <!-- Selección de rol -->
                                        <td>
                                            <select class="form-control" id="inputRol" name="rol" required>
                                                <option value="-1">Seleccione una opción...</option>
                                                <option value="Administrador">Administrador</option>
                                                <option value="Auditor">Auditor</option>
                                                <option value="Aprendiz">Aprendiz</option>
                                                <option value="Dinamizador SENNOVA">Dinamizador SENNOVA</option>
                                                <option value="Líder de proyecto">Líder de proyecto</option>
                                                <option value="Líder de semillero">Líder de semillero</option>
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
                <div id="alertasModificar"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
