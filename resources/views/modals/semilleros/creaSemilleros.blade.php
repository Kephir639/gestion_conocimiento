<div class="modal" id="modalRegistrarSemillero">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Registrar semillero</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" value="{{ csrf_token() }}" id="_token">
                    
                    <div class="row mt-3">
                        <!-- Nombre del Semillero -->
                        <div class="col-md-12 col-sm-12">
                            <label for="inputNombreSemillero" class="form-label">Nombre del Semillero</label>
                            <input type="text" class="form-control" id="inputNombreSemillero" name="nombre_semillero" required>
                        </div>

                        <!-- Iniciales del Semillero -->
                        <div class="col-md-12 col-sm-12 mt-3">
                            <label for="inputInicialesSemillero" class="form-label">Iniciales del Semillero</label>
                            <input type="text" class="form-control" id="inputInicialesSemillero" name="iniciales_semillero" required>
                        </div>

                        <!-- Fecha de Creación -->
                        <div class="col-md-12 col-sm-12 mt-3">
                            <label for="inputFechaCreacion" class="form-label">Fecha de Creación</label>
                            <input type="date" class="form-control" id="inputFechaCreacion" name="fecha_creacion" required>
                        </div>

                        <!-- Misión -->
                        <div class="col-md-12 col-sm-12 mt-3">
                            <label for="inputMisionSemillero" class="form-label">Misión</label>
                            <textarea class="form-control" id="inputMisionSemillero" name="mision" rows="3" required></textarea>
                        </div>

                        <!-- Visión -->
                        <div class="col-md-12 col-sm-12 mt-3">
                            <label for="inputVisionSemillero" class="form-label">Visión</label>
                            <textarea class="form-control" id="inputVisionSemillero" name="vision" rows="3" required></textarea>
                        </div>

                        <!-- Objetivo General -->
                        <div class="col-md-12 col-sm-12 mt-3">
                            <label for="inputObjetivoGeneral" class="form-label">Objetivo General</label>
                            <textarea class="form-control" id="inputObjetivoGeneral" name="objetivo_general" rows="2" required></textarea>
                        </div>

                        <!-- Objetivos Específicos -->
                        <div class="col-md-12 col-sm-12 mt-3">
                            <label for="inputObjetivosEspecificos" class="form-label">Objetivos Específicos</label>
                            <textarea class="form-control" id="inputObjetivosEspecificos" name="objetivos_especificos" rows="4" required></textarea>
                        </div>

                        <!-- ID Grupo -->
                        <div class="col-md-12 col-sm-12 mt-3">
                            <label for="inputIdGrupo" class="form-label">ID del Grupo</label>
                            <input type="number" class="form-control" id="inputIdGrupo" name="id_grupo" required>
                        </div>

                        <!-- ID Plan -->
                        {{-- <div class="col-md-12 col-sm-12 mt-3">
                            <label for="inputIdPlan" class="form-label">ID del Plan</label>
                            <input type="number" class="form-control" id="inputIdPlan" name="id_plan" required>
                        </div> --}}

                        <!-- Botón de envío -->
                        <div class="col-md-12 col-sm-12 mt-3">
                            <button class="btn btn-success w-100" type="submit">Enviar</button>
                        </div>
                    </div>
                </form>

                <div id="alertasRegistrarSemillero"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
