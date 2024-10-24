<div class="modal" id="modalModificarCentros">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Modificar centros</h5>
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
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_nombre_centro"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputNombreCentro" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="inputNombreCentro" name="nombre_centro"
                                required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_estado_centro"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputEstadoCentro" class="form-label">Estado</label>
                            <select type="select" class="form-control" id="inputEstadoCentro" name="estado_centro"
                                required>
                                <option value="">Seleccione una opcion</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-3">
                            <button id="btnActualizar" class="btn btn-success w-100">Enviar</button>
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
