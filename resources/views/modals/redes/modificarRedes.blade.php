<div class="modal" id="modalModificarRedes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Modificar Red</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formModificar">
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        <div id="div_nombre_red" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="nombre_red" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="inputNombreRed" name="nombre_red" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_estado_red" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="estado_red" class="form-label">Estado</label>
                            <select type="select" class="form-control" id="inputEstadoRed" name="estado_red" required>
                                <option value="-1">Seleccione una opcion</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-3">
                            <input type="submit" value="Enviar" class="btn btn-success w-100" name="Enviar">
                        </div>
                    </div>
                </form>
                <div id="alertasModificar">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
