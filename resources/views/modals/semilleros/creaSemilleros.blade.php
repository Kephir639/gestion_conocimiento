<div class="modal fade" id="modalRegistrarSemillero" tabindex="-1" aria-labelledby="modalRegistrarSemilleroLabel"
    aria-hidden="true">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
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
                        <div id="div_nombre_semillero" class="col-md-12">
                            <label for="inputNombreSemillero" class="form-label">Nombre del Semillero</label>
                            <input type="text" class="form-control" id="inputNombreSemillero" name="nombre_semillero"
                                required>
                            <span class="errorValidacion"></span>
                        </div>

                        <div id="div_iniciales_semillero" class="col-md-12 mt-3">
                            <label for="inputInicialesSemillero" class="form-label">Iniciales del Semillero</label>
                            <input type="text" class="form-control" id="inputInicialesSemillero"
                                name="iniciales_semillero" required>
                            <span class="errorValidacion"></span>

                        </div>

                        <div id="div_fecha_creacion" class="col-md-12 mt-3">
                            <label for="inputFechaCreacion" class="form-label">Fecha de Creación</label>
                            <input type="date" class="form-control" id="inputFechaCreacion" name="fecha_creacion"
                                required>
                            <span class="errorValidacion"></span>

                        </div>

                        <div id="div_lider_semillero" class="col-md-12 mt-3">
                            <label for="inputLiderSemillero" class="form-label">Lider del Semillero</label>
                            <input type="text" class="form-control" id="inputLiderSemillero" name="lider_semillero"
                                required>
                            <span class="errorValidacion"></span>

                        </div>


                        <div id="div_mision" class="col-md-12 mt-3">
                            <label for="inputMisionSemillero" class="form-label">Misión</label>
                            <textarea class="form-control" id="inputMisionSemillero" name="mision" rows="3" required></textarea>
                            <span class="errorValidacion"></span>
                        </div>

                        <div id="div_vision" class="col-md-12 mt-3">
                            <label for="inputVisionSemillero" class="form-label">Visión</label>
                            <textarea class="form-control" id="inputVisionSemillero" name="vision" rows="3" required></textarea>
                            <span class="errorValidacion"></span>
                        </div>

                        <div id="div_objetivo_general" class="col-md-12 mt-3">
                            <label for="inputObjetivoGeneral" class="form-label">Objetivo General</label>
                            <textarea class="form-control" id="inputObjetivoGeneral" name="objetivo_general" rows="2" required></textarea>
                            <span class="errorValidacion"></span>
                        </div>

                        <div div_objetivos_especificos class="col-md-12 mt-3">
                            <label for="inputObjetivosEspecificos" class="form-label">Objetivos Específicos</label>
                            <div id="objetivosEspecificosContainer">
                                <div class="input-group mb-3 objetivo-item">
                                    <input type="text" class="form-control" name="objetivos_especificos[]"
                                        placeholder="Objetivo específico" required>
                                    <button class="btn btn-success btnAddObjetivo" type="button">+</button>
                                    <span class="errorValidacion"></span>

                                </div>
                            </div>
                        </div>

                        <div id="div_id_grupo" class="col-md-12 mt-3">
                            <label for="inputIdGrupo" class="form-label">ID del Grupo</label>
                            <input type="number" class="form-control" id="inputIdGrupo" name="id_grupo" required>
                            <span class="errorValidacion"></span>
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
