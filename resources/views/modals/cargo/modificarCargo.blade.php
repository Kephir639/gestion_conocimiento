<div class="modal" id="modalModificarCargo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Modificar cargo</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formModificar">
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputNombreCargo" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="inputNombreCargo" name="nombre_cargo"
                                required>
                        </div>
                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputEstadoCargo" class="form-label">Estado</label>
                            <select type="select" class="form-control" id="inputEstadoCargo" name="estado_cargo"
                                required>
                                <option value="-1">Seleccione una opcion...</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
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
