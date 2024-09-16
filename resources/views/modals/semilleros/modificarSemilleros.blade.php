<div class="modal" id="ModalModificarSemilleros">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Modificar Semillero</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        
                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputNombreSemillero" class="form-label">Nombre del Semillero</label>
                            <input type="text" class="form-control" id="inputNombreSemillero" name="nombre_semillero" required>
                        </div>

                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center mt-3">
                            <label for="inputIniciales" class="form-label">Iniciales</label>
                            <input type="text" class="form-control" id="inputIniciales" name="iniciales" required>
                        </div>

                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center mt-3">
                            <label for="inputLider" class="form-label">Líder del Semillero</label>
                            <input type="text" class="form-control" id="inputLider" name="lider_semillero" required>
                        </div>

                        <div class="col-md-12 col-sm-12 mt-3">
                            <button class="btn btn-success w-100">Enviar</button>
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
