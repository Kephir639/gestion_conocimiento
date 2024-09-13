<div class="modal" id="modalRegistrarSemilleros">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Registrar Semillero</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        <div id="div_nombre_semillero"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputNombreSemillero" class="form-label">Nombre Semillero</label>
                            <input type="text" class="form-control" id="inputNombreSemillero" name="nombre_semillero"
                                required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_iniciales_semilleros"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputInicialesSemillero" class="form-label">Iniciales</label>
                            <input type="text" class="form-control" id="inputInicialesSemillero"
                                name="iniciales_semilleros" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_fecha_creacion"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputFechaCreacion" class="form-label">Fecha de Creacion</label>
                            <input type="date" class="form-control" id="inputFechaCreacion" name="fecha_creacion"
                                required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_integrantes" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputIntegrantesSemillero" class="form-label">Integrantes</label>
                            <select class="form-control" id="inputIntegrantesSemillero" name="integrantes" required>
                                {{-- @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->identificacion }}">{{ $usuario->name }}
                                        {{ $usuario->apellidos }} - {{ $usuario->rol }}</option>
                                @endforeach --}}
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_mision" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputMision" class="form-label">Mision</label>
                            <input type="text" class="form-control" id="inputMision" name="mision" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_vision" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputVision" class="form-label">Vision</label>
                            <input type="text" class="form-control" id="inputVision" name="vision" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_objetivo_general"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputObjetivoGeneral" class="form-label">Objetivo General</label>
                            <input type="text" class="form-control" id="inputObjetivoGeneral" name="objetivo_general"
                                required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_objetivos_especificos"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            {{-- A la hora de agregar un campo y que lo dejen vacio
                                identificar su posicion e ignorar el null que contiene --}}
                            <label for="inputObjetivosEspecificos" class="form-label">Actividades</label>
                            <div class="campoMultiple">
                                {{-- En caso de error de validacion, recorrer el array de los divs
                                    de campo multiple y poner el mensaje en el div correspondiente --}}
                                <input type="text" class="form-control" id="inputObjetivosEspecificos"
                                    name="objetivos_especificos[]" required>
                                <span class="errorValidacion"></span>
                            </div>
                        </div>
                        <div id="div_grupos" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputGrupos" class="form-label">Grupos de Investigacion</label>
                            <select class="form-control" id="inputGrupos" name="grupos" required>
                                {{-- @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->id }}">{{ $grupo->nombre_grupo }}</option>
                                @endforeach --}}
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_lineas" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputLineas" class="form-label">Lineas de Investigacion</label>
                            <select class="form-control" id="inputLineas" name="lineas" required>
                                {{-- @foreach ($lineas as $linea)
                                    <option value="{{ $linea->id }}">{{ $linea->nombre_linea }}</option>
                                @endforeach --}}
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_programas" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputProgramas" class="form-label">Programas de Formacion</label>
                            <select class="form-control" id="inputProgramas" name="progamas" required>
                                {{-- @foreach ($programas as $programa)
                                    <option value="{{ $programa->id }}">{{ $programa->nombre_programa }}</option>
                                @endforeach --}}
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_redes" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputRedes" class="form-label">Redes de Investigacion</label>
                            <select class="form-control" id="inputRedes" name="redes" required>
                                {{-- @foreach ($redes as $red)
                                    <option value="{{ $red->id }}">{{ $red->nombre_red }}</option>
                                @endforeach --}}
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_integrantes"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputIntegrantes" class="form-label">Integrantes</label>
                            <select class="form-control" id="inputIntegrantes" name="integrantes" required>
                                {{-- @foreach ($integrantes as $integrante)
                                    <option value="{{ $integrante->id }}">{{ $integrante->nombre_integrante }}
                                    </option>
                                @endforeach --}}
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_actividades"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            {{-- A la hora de agregar un campo y que lo dejen vacio
                                identificar su posicion e ignorar el null que contiene --}}
                            <label for="inputActividades" class="form-label">Actividades</label>
                            <div class="campoMultiple">
                                {{-- En caso de error de validacion, recorrer el array de los divs
                                    de campo multiple y poner el mensaje en el div correspondiente --}}
                                <input type="text" class="form-control" id="inputActividades"
                                    name="actividades[]" required>
                                <span class="errorValidacion"></span>
                            </div>
                        </div>
                        <div id="div_tareas" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            {{-- A la hora de agregar un campo y que lo dejen vacio
                                identificar su posicion e ignorar el null que contiene --}}
                            <label for="inputTareas" class="form-label">Actividades</label>
                            <div class="campoMultiple">
                                {{-- En caso de error de validacion, recorrer el array de los divs
                                    de campo multiple y poner el mensaje en el div correspondiente --}}
                                <input type="text" class="form-control" id="inputTareas" name="tareas[]"
                                    required>
                                <span class="errorValidacion"></span>
                            </div>
                        </div>
                        <div id="div_productos" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            {{-- A la hora de agregar un campo y que lo dejen vacio
                                identificar su posicion e ignorar el null que contiene --}}
                            <label for="inputProductos" class="form-label">Productos</label>
                            <div class="campoMultiple">
                                {{-- En caso de error de validacion, recorrer el array de los divs
                                    de campo multiple y poner el mensaje en el div correspondiente --}}
                                <input type="text" class="form-control" id="inputProductos" name="productos[]"
                                    required>
                                <span class="errorValidacion"></span>
                            </div>
                        </div>
                        <div id="div_responsables"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            {{-- A la hora de agregar un campo y que lo dejen vacio
                                identificar su posicion e ignorar el null que contiene --}}
                            <label for="inputResponsables" class="form-label">Responsables</label>
                            <div class="campoMultiple">
                                {{-- En caso de error de validacion, recorrer el array de los divs
                                    de campo multiple y poner el mensaje en el div correspondiente --}}
                                <input type="text" class="form-control" id="inputResponsables"
                                    name="responsables[]" required>
                                <span class="errorValidacion"></span>
                            </div>
                        </div>
                        {{-- Input de Frecuencia (fecha inicio y fecha fin) --}}
                        <div id="div_frecuencia"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputFechaInicio" class="form-label">Frecuencia</label><br>
                            <span>Incio</span><input type="date" class="form-control" id="inputFechaInicio"
                                name="fecha_inicio" required><br>
                            <span>Final</span>
                            <input type="date" class="form-control" id="inputFechaFinal" name="fecha_inicio"
                                required>
                            <span class="errorValidacion"></span>
                        </div>

                        <div class="col-md-12 col-sm-12 mt-3">
                            <button id="btnRegistrar" class="btn btn-success w-100">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
