<div class="modal" id="modalRegistrarProyectoInvestigacion">
    <div class="modal-dialog modal-fixed">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Registrar Proyecto</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        <div id="div_ano_proyecto"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputAnoProyecto" class="form-label">Año de ejecucion</label>
                            <input type="year" class="form-control" id="inputAnoProyecto" name="ano_proyecto"
                                required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_codigo_SIGP" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputCodigoSIGP" class="form-label">Codigo SIGP</label>
                            <input type="text" class="form-control" id="inputCodigoSIGP" name="codigo_SIGP" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_nombre_proyecto"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputNombreProyecto" class="form-label">Nombre del proyecto</label>
                            <input type="text" class="form-control" id="inputNombreProyecto" name="nombre_proyecto"
                                required>
                            <span class="errorValidacion"></span>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="div_centros" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputCentros" class="form-label">Centros de formacion</label>
                            <select class="form-control" name="centros[]" id="inputCentros" required>
                                <option value="">Seleccione una opcion...</option>
                                @foreach ($centros as $centro)
                                    <option value="{{ $centro->id_centro }}">{{ $centro->nombre_centro }}</option>
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_grupos" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputGrupos" class="form-label">Grupos de investigacion</label>
                            <select class="form-control" name="grupos[]" id="inputGrupos" required>
                                <option value="">Seleccione una opcion...</option>
                                @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->id_grupo }}">{{ $grupo->nombre_grupo }}</option>
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_lineas" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputLineas" class="form-label">Lineas de investigacion</label>
                            <select class="form-control" name="lineas[]" id="inputLineas" required>
                                <option value="">Seleccione una opcion...</option>
                                @foreach ($lineas as $linea)
                                    <option value="{{ $linea->id_linea }}">{{ $linea->nombre_linea }}</option>
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_redes" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputRedes" class="form-label">Redes de conocimiento</label>
                            <select class="form-control" name="redes[]" id="inputRedes" required>
                                <option value="">Seleccione una opcion...</option>
                                @foreach ($redes as $red)
                                    <option value="{{ $red->id_red }}">{{ $red->nombre_red }}</option>
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_programas" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputProgramas" class="form-label">Programas de formacion</label>
                            <select type="text" class="form-control" name="programas[]" id="inputProgramas" required>
                                <option value="">Seleccione una opcion...</option>
                                @foreach ($programas as $programas)
                                    <option value="{{ $programas->id_programa }}">{{ $programas->nombre_programa }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="idv_semilleros" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputSemilleros" class="form-label">Semilleros de investigacion</label>
                            <select type="text" class="form-control" name="semilleros[]" id="inputSemilleros"
                                required>
                                <option value="">Seleccione una opcion...</option>
                                @foreach ($semilleros as $semillero)
                                    <option value="{{ $semillero->id_semillero }}">{{ $semillero->nombre_semillero }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="div_participantes"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputParticipantes" class="form-label">Participantes</label>
                            <select type="text" class="form-control" name="participantes[]"
                                id="inputParticipantes" required>
                                <option value="">Seleccione una opcion...</option>
                                @foreach ($participantes as $participante)
                                    <option value="{{ $participante->id }}">{{ $participante->name }}
                                        {{ $participante->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_resumen_proyecto"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputResumenProyecto" class="form-label">Resumen proyecto</label>
                            <input type="text" class="form-control" id="inputResumenProyecto"
                                name="resumen_proyecto" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_objetivo_general"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputObjetivoGeneral" class="form-label">Objetivo general</label>
                            <input type="text" class="form-control" id="inputObjetivoProyecto"
                                name="objetivo_general" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_objetivos_especificos"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputObjetivosEspecificos" class="form-label">Objetivos especificos</label>
                            <input type="text" class="form-control" name="objetivos_especificos[]" required>
                            <a class="btnAgregar btn btn-success">+</a>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_propuesta" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputPropuesta" class="form-label">Propuesta de sostenibilidad</label>
                            <input type="text" class="form-control" id="inputPropuesta" name="propuesta"
                                required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputImpacto" class="form-label">Impacto esperado</label>
                            <input type="text" class="form-control" id="inputImpacto" name="impacto" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="tablas">
                            <div id="actividades">
                                <div class="col-md-12 col-sm-12 justify-content-center align-items-center grupoInput">
                                    <label for="" class="form-label">Actividades</label>
                                    <table id="camposAgregables">
                                        <thead>
                                            <td>Descripcion</td>
                                            <td>Actividad</td>
                                            <td>Entregable</td>
                                            <td>Enlace</td>
                                            <td>Se cumple</td>
                                            <td>Observaciones</td>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control simple"
                                                        id="inputDescripcion" name="descripcion[1][]" required>
                                                    <span class="errorValidacion"></span>
                                                </td>
                                                <td>
                                                    <div class="input-agregar">
                                                        <div class="campo_principal input-group">
                                                            <input type="text" class="form-control agregable"
                                                                name="actividades[1][1][]" required><a href="#"
                                                                class="btnAgregar btn btn-success">+</a
                                                                href="#">
                                                            <span class="errorValidacion"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-agregar">
                                                        <div class="campo_principal input-group">
                                                            <input type="text" class="form-control agregable"
                                                                name="entregables[1][1][]" required><a href="#"
                                                                class="btnAgregar btn btn-success">+</a
                                                                href="#">
                                                            <span class="errorValidacion"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control simple"
                                                        id="inputEnlace" name="enlace_evidencia[1][]" required>
                                                    <span class="errorValidacion"></span>
                                                </td>
                                                <td>
                                                    <select class="form-control simple" name="cumplido[1][]"
                                                        id="inputCumplido">
                                                        <option value="-1">Seleccione una opcion...</option>
                                                        <option value="si">Si</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                    <span class="errorValidacion"></span>
                                                </td>
                                                <td>
                                                    <div class="input-agregar">
                                                        <div class="campo_principal input-group">
                                                            <input type="text" class="form-control agregable"
                                                                name="observaciones[1][1][]" required><a
                                                                href="#" class="btnAgregar btn btn-success">+</a
                                                                href="#">
                                                            <span class="errorValidacion"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <button id="btnAgregarActividad" class="btn btn-success">+</button>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div id="presupuestos">
                                <div class="col-md-12 col-sm-12 justify-content-center align-items-center grupoInput">
                                    <label for="" class="form-label">Presupuesto del proyecto</label>
                                    <table id="camposAgregables">
                                        <thead>
                                            <td>Concepto interno SENA</td>
                                            <td>Rubro</td>
                                            <td>uso presupuestal</td>
                                            <td>Valor planeado</td>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control simple"
                                                        id="inputConcepto" name="concepto[1][]" required>
                                                    <span class="errorValidacion"></span>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control simple" id="inputRubro"
                                                        name="rubro[1][]" required>
                                                    <span class="errorValidacion"></span>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control simple" id="inputUso"
                                                        name="uso_presupuestal[1][]" required>
                                                    <span class="errorValidacion"></span>
                                                </td>
                                                <td>
                                                    <div class="input-agregar">
                                                        <div class="campo_principal input-group">
                                                            <input type="text" class="form-control agregable"
                                                                name="valor_planteado[1][1][]" required><a
                                                                class="btnAgregar btn btn-success">+</a>
                                                            <span class="errorValidacion"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <button id="btnAgregarPresupuesto" class=" btn btn-success">+</button>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="col-md-12 col-sm-12 mt-3">
                                <button id="btnRegistrar" class="btn btn-success w-100">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <div id="alertasRegistrar"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
