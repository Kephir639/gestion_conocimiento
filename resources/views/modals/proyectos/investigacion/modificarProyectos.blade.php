<div class="modal" id="modalActualizarProyectoInvestigacion">
    <div class="modal-dialog">
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
                                value="{{ $proyecto->ano_ejecucion }}" required>
                        </div>
                        <div id="div_codigo_SIGP" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputCodigoSIGP" class="form-label">Codigo SIGP</label>
                            <input type="text" class="form-control" id="inputCodigoSIGP" name="codigo_SIGP"
                                value="{{ $proyecto->codigo_sigp }}" required>
                        </div>
                        <div id="div_nombre_proyecto"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputNombreProyecto" class="form-label">Nombre del proyecto</label>
                            <input type="text" class="form-control" id="inputNombreProyecto" name="nombre_proyecto"
                                value="{{ $proyecto->nombre_proyecto }}" required>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="div_centros" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputCentros" class="form-label">Centros de formacion</label>
                            <select class="form-control" id="inputCentros" name="centros[]" required>
                                @foreach ($centros as $centro)
                                    @foreach ($proyectos_centros as $proyecto_centro)
                                        <option
                                            {{ $proyecto_centro->id_centro == $centro->id_centro ? 'selected' : null }}
                                            value="{{ $centro->id_centro }}">{{ $centro->nombre_centro }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div id="div_grupos" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputGrupos" class="form-label">Grupos de investigacion</label>
                            <select class="form-control" id="inputGrupos" name="grupos[]" required>
                                @foreach ($grupos as $grupo)
                                    @foreach ($proyectos_grupos as $proyecto_grupo)
                                        <option {{ $proyecto_grupo->id_grupo == $grupo->id_grupo ? 'selected' : null }}
                                            value="{{ $grupo->id_grupo }}">{{ $grupo->nombre_grupo }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div id="div_lineas" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputLineas" class="form-label">Lineas de investigacion</label>
                            <select class="form-control" id="inputLineas" name="lineas[]" required>
                                @foreach ($lineas as $linea)
                                    @foreach ($proyectos_lineas as $proyecto_linea)
                                        <option {{ $proyecto_linea->id_linea == $linea->id_linea ? 'selected' : null }}
                                            value="{{ $linea->id_linea }}">{{ $linea->nombre_linea }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div id="div_redes" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputRedes" class="form-label">Redes de conocimiento</label>
                            <select class="form-control" id="inputRedes" name="redes[]" required>
                                @foreach ($centros as $centro)
                                    @foreach ($proyectos_centros as $proyecto_centro)
                                        <option
                                            {{ $proyecto_centro->id_centro == $centro->id_centro ? 'selected' : null }}
                                            value="{{ $centro->id_centro }}">{{ $centro->nombre_centro }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div id="div_programas" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputProgramas" class="form-label">Programas de formacion</label>
                            <select type="text" class="form-control" id="inputProgramas" name="programas[]" required>
                                @foreach ($programas as $programa)
                                    @foreach ($proyectos_programas as $proyectos_programas)
                                        <option
                                            {{ $proyecto_programa->id_programa == $programa->id_programa ? 'selected' : null }}
                                            value="{{ $programa->id_programa }}">{{ $programa->nombre_programa }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div id="idv_semilleros" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputSemilleros" class="form-label">Semilleros de investigacion</label>
                            <select type="text" class="form-control" id="inputSemilleros" name="semilleros[]"
                                required>
                                @foreach ($semilleros as $semillero)
                                    @foreach ($proyectos_semilleros as $proyecto_semillero)
                                        <option
                                            {{ $proyecto_semillero->id_semillero == $semillero->id_semillero ? 'selected' : null }}
                                            value="{{ $semillero->id_semillero }}">{{ $semillero->nombre_semillero }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="div_participantes"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputParticipantes" class="form-label">Participantes</label>
                            <select type="text" class="form-control" id="inputParticipantes" name="participantes[]"
                                required>
                                @foreach ($participantes as $participante)
                                    @foreach ($proyectos_participantes as $proyecto_participante)
                                        <option
                                            {{ $proyecto_participante->id == $participante->id ? 'selected' : null }}
                                            value="{{ $participante->id }}">{{ $participante->nombre }}
                                            {{ $participante->apellidos }}
                                    @endforeach
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="div_resumen_proyecto"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputResumenProyecto" class="form-label">Resumen proyecto</label>
                            <input type="text" class="form-control" id="inputResumenProyecto"
                                value="{{ $proyecto->resumen }}" name="resumen_proyecto" required>
                        </div>
                        <div id="div_objetivo_general"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputObjetivoGeneral" class="form-label">Objetivo general</label>
                            <input type="text" class="form-control" id="inputObjetivoProyecto"
                                value="{{ $proyecto->objetivo_general }}" name="objetivo_general" required>
                        </div>
                        <div id="div_objetivos_especificos"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputObjetivosEspecificos" class="form-label">Objetivos especificos</label>
                            @foreach ($objetivos as $objetivo)
                                <input type="text" class="form-control" name="objetivos_especificos[]"
                                    value="{{ $objetivo->objetivo_especifico }}" required>
                            @endforeach
                            <button class="btnAgregar">+</button>
                        </div>
                        <div id="div_propuesta" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputPropuesta" class="form-label">Propuesta de sostenibilidad</label>
                            <input type="text" class="form-control" id="inputPropuesta" name="propuesta"
                                value="{{ $proyecto->propuesta }}" required>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputImpacto" class="form-label">Impacto esperado</label>
                            <input type="text" class="form-control" id="inputImpacto" name="impacto"
                                value="{{ $proyecto->impacto_esperado }}" required>
                        </div>
                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="campoActividades" class="form-label">Actividades</label>
                            <table id="campoActividades">
                                <thead>
                                    <td>Descripcion</td>
                                    <td>Actividad</td>
                                    <td>Entregable</td>
                                    <td>Enlace evidencia</td>
                                    <td>Se cumple</td>
                                    <td>Observaciones</td>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input value="{{ $proyecto->descripcion }}" type="text"
                                                class="form-control" id="inputDescripcion" name="descripcion"
                                                required>
                                        </td>
                                        <td>
                                            @foreach ($actividades as $actividad)
                                                <input value="{{ $actividad->actividad }}" type="text"
                                                    class="form-control" name="actividades[]" required>
                                            @endforeach
                                            <button id="btnAgregar">+</button>
                                        </td>
                                        <td>
                                            @foreach ($entregables as $entregable)
                                                <input type="text" class="form-control" name="entregables[]"
                                                    value="{{ $entregable->entregable }}" required>
                                            @endforeach
                                            <button id="btnAgregar">+</button>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="inputEnlace"
                                                name="enlace_evidencia" required>
                                        </td>
                                        <td>
                                            <select name="cumplido" id="inputCumplido">
                                                <option value="-1">Seleccione una opcion...</option>
                                                <option {{ $proyecto->cumplido == 'si' ? 'selected' : null }}
                                                    value="si">Si</option>
                                                <option {{ $proyecto->cumplido == 'no' ? 'selected' : null }}
                                                    value="no">No</option>

                                            </select>
                                        </td>
                                        <td>
                                            @foreach ($observaciones as $observacion)
                                                <input type="text" class="form-control" name="observaciones[]"
                                                    value="{{ $observacion }}" required>
                                            @endforeach
                                            <button id="btnAgregar">+</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <button id="agregarActividad">+</button>
                            </table>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="" class="form-label">Presupuesto del proyecto</label>
                            <table id="campoPresupuesto">
                                <thead>
                                    <td>Concepto interno SENA</td>
                                    <td>Rubro</td>
                                    <td>uso presupuestal</td>
                                    <td>Valor planeado</td>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" id="inputConcepto"
                                                name="concepto" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="inputRubro"
                                                name="rubro" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="inputUso"
                                                name="uso_presupuestal" required>
                                        </td>
                                        <td>
                                            @foreach ($valores as $valor)
                                                <input type="text" class="form-control" name="valor_planteado[]"
                                                    value="{{ $valor->valor }}" required>
                                            @endforeach
                                            <button id="btnAgregar">+</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <button id="agregarPresupuesto">+</button>
                            </table>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="col-md-12 col-sm-12 mt-3">
                            <button class="btn btn-success w-100">Enviar</button>
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
