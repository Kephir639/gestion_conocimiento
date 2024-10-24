<div class="modal" id="modalModificarGrupos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Modificar Grupo</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        <div id="div_nombre_grupo"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputNombreGrupo" class="form-label">Nombre grupo</label>
                            <input type="text" class="form-control" id="inputNombreGrupo" name="nombre_grupo"
                                required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_estado_grupo"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputEstadoGrupo" class="form-label">Estado grupo</label>
                            <select type="select" class="form-control" id="inputEstadoGrupo" name="estado_grupo"
                                required>
                                <option value="-1">Seleccione una opcion</option>
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
