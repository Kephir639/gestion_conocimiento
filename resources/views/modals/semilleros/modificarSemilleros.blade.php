<div class="modal" id="ModalModificarSemilleros">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Modificar Semillero</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formModificarSemillero">
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_tokenSemillero">
                        <div id="div_nombre_semillero"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="nombre_semillero" class="form-label">Nombre del Semillero</label>
                            <input type="text" class="form-control" id="inputNombreSemillero" name="nombre_semillero"
                                required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_iniciales_semillero"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="iniciales_semillero" class="form-label">Iniciales del Semillero</label>
                            <input type="text" class="form-control" id="inputInicialesSemillero"
                                name="iniciales_semillero" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_lider_semillero"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="lider_semillero" class="form-label">Líder del Semillero</label>
                            <input type="text" class="form-control" id="inputLiderSemillero" name="lider_semillero"
                                required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-3">
                            <button id="btnModificarSemillero" class="btn btn-success w-100">Enviar</button>
                        </div>
                    </div>
                </form>
                <div id="alertasModificarSemillero">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
