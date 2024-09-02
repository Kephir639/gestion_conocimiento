<div class="modal" id="modalRegistrarCentros">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Registrar centros</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        <div id="div_codigo_centro"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputCodigoCentro" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="inputCodigoCentro" name="codigo_centro"
                                required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_nombre_centro"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputNombrecentro" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="inputNombrecentro" name="nombre_centro"
                                required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-3">
                            <input type="submit" value="Enviar" class="btn btn-success w-100" name="Enviar">
                        </div>
                    </div>
                </form>
                <div id="alertasRegistrar">

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
