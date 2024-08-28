<<<<<<< HEAD
<div class="modal" id="modalRegistrarGrupo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Registrar grupo</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
=======
<div class="modal" id="modalRegistrarGrupos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Registrar Grupo</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formRegistrar">
>>>>>>> 223875880eee132c6a0675e6eaa126f68479e7f9
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="nombre_grupo" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="inputNombreGrupo" name="nombre_grupo"
                                required>
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
