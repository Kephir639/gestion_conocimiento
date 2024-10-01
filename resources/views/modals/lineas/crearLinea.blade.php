<div class="modal" id="modalRegistrarLinea">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Registrar linea</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        <div id="div_nombre_linea"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputNombreLinea" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="inputNombreLinea" name="nombre_linea"
                                required>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-3">
                            <button class="btn btn-success w-100">Enviar</button>
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
