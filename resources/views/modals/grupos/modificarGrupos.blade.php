<<<<<<< HEAD
<div class="modal" id="modalModificarGrupo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Modificar grupo</h5>
=======
<div class="modal" id="modalModificarGrupos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Modificar Grupo</h5>
>>>>>>> 223875880eee132c6a0675e6eaa126f68479e7f9
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formModificar">
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="nombre_grupo" class="form-label">Nombre</label>
<<<<<<< HEAD
                            <input type="text" class="form-control" id="inputNombregrupo" name="nombre_grupo"
=======
                            <input type="text" class="form-control" id="inputNombreGrupo" name="nombre_grupo"
>>>>>>> 223875880eee132c6a0675e6eaa126f68479e7f9
                                required>
                        </div>
                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="estado_grupo" class="form-label">Estado</label>
<<<<<<< HEAD
                            <select type="select" class="form-control" id="inputEstadogrupo" name="estado_grupo"
=======
                            <select type="select" class="form-control" id="inputEstadoGrupo" name="estado_grupo"
>>>>>>> 223875880eee132c6a0675e6eaa126f68479e7f9
                                required>
                                <option value="-1">Seleccione una opcion</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
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
