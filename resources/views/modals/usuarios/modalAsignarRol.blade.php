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

                        <!-- Nombre de usuario -->
                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputNombreUsuario" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="inputNombreUsuario" name="nombre_usuario"
                                required>
                        </div>

                        <!-- Selección de rol -->
                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center mt-3">
                            <label for="inputRol" class="form-label">Rol</label>
                            <select class="form-control" id="inputRol" name="rol" required>
                                <option value="-1">Seleccione una opción...</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Auditor">Auditor</option>
                                <option value="Aprendiz">Aprendiz</option>
                                <option value="Dinamizador SENNOVA">Dinamizador SENNOVA</option>
                                <option value="Líder de proyecto">Líder de proyecto</option>
                                <option value="Líder de semillero">Líder de semillero</option>
                            </select>
                        </div>

                        <!-- Botón enviar -->
                        <div class="col-md-12 col-sm-12 mt-3">
                            <button id="btnEnviarRol" type="submit" class="btn btn-success w-100">Enviar</button>
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
