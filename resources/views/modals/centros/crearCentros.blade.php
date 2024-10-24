<div class="modal" id="modalRegistrarCentro">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Registrar Centros</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        <div id="div_codigo_centro"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputCodigoCentro" class="form-label">Codigo</label>
                            <input type="text" class="form-control" id="inputCodigoCentro" name="codigo_centro"
                                required>
                            <div class="errorValidacion"></div>
                        </div>
                        <div id="div_nombre_centro"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputNombrecentro" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="inputNombreCentro" name="nombre_centro"
                                required>
                            <div class="errorValidacion"></div>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-3">
                            <button id="btnRegistrar" class="btn btn-success w-100">Enviar</button>
                        </div>
                    </div>
                </form>
                <div id="alertasRegistrar"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
