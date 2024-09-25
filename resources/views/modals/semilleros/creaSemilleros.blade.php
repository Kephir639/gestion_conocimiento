<style>
    /* Ajustes de la modal */
    .modal-content {
        border-radius: 9px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        background-color: #007430;
        /* Color primario (puedes usar tu variable personalizada si tienes una) */
        color: #fff;
        border-bottom: none;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .modal-header h5 {
        margin: 0;
        font-weight: bold;
    }

    .modal-body {
        padding: 20px;
        background-color: #f8f9fa;
        /* Fondo suave */
    }

    .modal-footer {
        border-top: none;
        background-color: #f8f9fa;
    }

    .btn-close {
        color: #fff;
        opacity: 1;
    }

    .form-label {
        font-weight: bold;
    }

    textarea.form-control,
    input.form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
    }

    .btn-success {
        background-color: #007430;
        border: none;
        font-weight: bold;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    #alertasRegistrarSemillero {
        margin-top: 10px;
    }
</style>

<div class="modal fade" id="modalRegistrarSemillero" tabindex="-1" aria-labelledby="modalRegistrarSemilleroLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalRegistrarSemilleroLabel">Registrar Semillero</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formRegistrarSemillero">
                    <input type="hidden" value="{{ csrf_token() }}" id="_token">

                    <div class="row">
                        <div class="col-md-12">
                            <label for="inputNombreSemillero" class="form-label">Nombre del Semillero</label>
                            <input type="text" class="form-control" id="inputNombreSemillero" name="nombre_semillero"
                                required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputInicialesSemillero" class="form-label">Iniciales del Semillero</label>
                            <input type="text" class="form-control" id="inputInicialesSemillero"
                                name="iniciales_semillero" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputFechaCreacion" class="form-label">Fecha de Creación</label>
                            <input type="date" class="form-control" id="inputFechaCreacion" name="fecha_creacion"
                                required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputMisionSemillero" class="form-label">Misión</label>
                            <textarea class="form-control" id="inputMisionSemillero" name="mision" rows="3" required></textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputVisionSemillero" class="form-label">Visión</label>
                            <textarea class="form-control" id="inputVisionSemillero" name="vision" rows="3" required></textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputObjetivoGeneral" class="form-label">Objetivo General</label>
                            <textarea class="form-control" id="inputObjetivoGeneral" name="objetivo_general" rows="2" required></textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputObjetivosEspecificos" class="form-label">Objetivos Específicos</label>
                            <textarea class="form-control" id="inputObjetivosEspecificos" name="objetivos_especificos" rows="4" required></textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="inputIdGrupo" class="form-label">ID del Grupo</label>
                            <input type="number" class="form-control" id="inputIdGrupo" name="id_grupo" required>
                        </div>

                        <div class="col-md-12 mt-3">
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
