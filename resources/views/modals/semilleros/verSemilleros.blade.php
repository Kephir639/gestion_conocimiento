<div class="modal" id="modalVerSemillero" tabindex="-1" aria-labelledby="modalVerSemilleroLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerSemilleroLabel">Detalles del Semillero</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formVerSemillero">
                    <input type="hidden" value="{{ csrf_token() }}" id="_token">

                    <div class="row">
                        <div class="col-md-12">
                            <label for="inputNombreSemillero" class="form-label">Nombre del Semillero</label>
                            <input type="text" class="form-control" id="inputNombreSemillero" name="nombre_semillero"
                                value="{{ $semillero->nombre_semillero }}" required readonly>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputInicialesSemillero" class="form-label">Iniciales del Semillero</label>
                            <input type="text" class="form-control" id="inputInicialesSemillero"
                                value="{{ $semillero->iniciales_semillero }}" required readonly>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputFechaCreacion" class="form-label">Fecha de Creación</label>
                            <input type="date" class="form-control" id="inputFechaCreacion" name="fecha_creacion"
                                value="{{ $semillero->fecha_creacion }}" required readonly>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputLiderSemillero" class="form-label">Lider del Semillero</label>
                            <input type="text" class="form-control" id="inputLiderSemillero" name="lider_semillero"
                                value="{{ $semillero->lider_semillero }}" required readonly>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputMisionSemillero" class="form-label">Misión</label>
                            <input type="text" class="form-control" id="inputMisionSemillero" name="mision"
                                value="{{ $semillero->mision }}" required readonly>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputVisionSemillero" class="form-label">Visión</label>
                            <input type="text" class="form-control" id="inputVisionSemillero" name="vision"
                                value="{{ $semillero->vision }}" required readonly>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputObjetivoGeneral" class="form-label">Objetivo General</label>
                            <input type="text" class="form-control" id="inputObjetivoGeneral" name="objetivo_general"
                                value="{{ $semillero->objetivo_general }}" required readonly>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputGrupo" class="form-label">Grupo</label>
                            <input type="text" class="form-control" id="inputGrupo" name="id_grupo"
                                value="{{ $semillero->id_grupo }}" required readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
