<div class="modal" id="modalActualizarProyectoInvestigacion">
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
                                value="{{ $proyecto->first()->ano_ejecucion }}" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_codigo_SIGP" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputCodigoSIGP" class="form-label">Codigo SIGP</label>
                            <input type="text" class="form-control" id="inputCodigoSIGP" name="codigo_SIGP"
                                value="{{ $proyecto->first()->codigo_sigp }}" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_nombre_proyecto"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputNombreProyecto" class="form-label">Nombre del proyecto</label>
                            <input type="text" class="form-control" id="inputNombreProyecto" name="nombre_proyecto"
                                value="{{ $proyecto->first()->nombre_proyecto }}" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="div_centros" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputCentros" class="form-label">Centros de formacion</label>
                            <select class="form-control" id="selectCentros" name="centros[]" required>
                                @foreach ($centros as $centro)
                                    @foreach ($centros_proyecto as $centro_p)
                                        <option {{ $centro_p->id_centro == $centro->id_centro ? 'selected' : null }}
                                            value="{{ $centro->id_centro }}">{{ $centro->nombre_centro }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_grupos" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="selectGrupos" class="form-label">Grupos de investigacion</label>
                            <select class="form-control" id="selectGrupos" name="grupos[]" required>
                                @foreach ($grupos as $grupo)
                                    @foreach ($grupos_proyecto as $grupo_p)
                                        <option {{ $grupo_p->id_grupo == $grupo->id_grupo ? 'selected' : null }}
                                            value="{{ $grupo->id_grupo }}">{{ $grupo->nombre_grupo }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_lineas" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="selectLineas" class="form-label">Lineas de investigacion</label>
                            <select class="form-control" id="selectLineas" name="lineas[]" required>
                                @foreach ($lineas as $linea)
                                    @foreach ($lineas_proyecto as $linea_p)
                                        <option {{ $linea_p->id_linea == $linea->id_linea ? 'selected' : null }}
                                            value="{{ $linea->id_linea }}">{{ $linea->nombre_linea }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_redes" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="selectRedes" class="form-label">Redes de conocimiento</label>
                            <select class="form-control" id="selectRedes" name="redes[]" required>
                                @foreach ($redes as $red)
                                    @foreach ($redes_proyecto as $red_p)
                                        <option {{ $red_p->id_red == $red->id_red ? 'selected' : null }}
                                            value="{{ $red->id_red }}">{{ $red->nombre_red }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_programas" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="selectProgramas" class="form-label">Programas de formacion</label>
                            <select type="text" class="form-control" id="selectProgramas" name="programas[]"
                                required>
                                @foreach ($programas as $programa)
                                    @foreach ($programas_proyecto as $programa_p)
                                        <option
                                            {{ $programa_p->id_programa == $programa->id_programa ? 'selected' : null }}
                                            value="{{ $programa->id_programa }}">{{ $programa->nombre_programa }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="idv_semilleros" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="selectSemilleros" class="form-label">Semilleros de investigacion</label>
                            <select type="text" class="form-control" id="selectSemilleros" name="semilleros[]"
                                required>
                                @foreach ($semilleros as $semillero)
                                    @foreach ($semilleros_proyecto as $semillero_p)
                                        <option
                                            {{ $semillero_p->id_semillero == $semillero->id_semillero ? 'selected' : null }}
                                            value="{{ $semillero->id_semillero }}">{{ $semillero->nombre_semillero }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="div_participantes"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="selectParticipantes" class="form-label">Participantes</label>
                            <select type="text" class="form-control" id="selectParticipantes"
                                name="participantes[]" required>
                                @foreach ($participantes as $participante)
                                    @foreach ($participantes_proyecto as $participante_p)
                                        <option {{ $participante_p->id == $participante->id ? 'selected' : null }}
                                            value="{{ $participante->id }}">{{ $participante->name }}
                                            {{ $participante->apellidos }}
                                    @endforeach
                                    </option>
                                @endforeach
                            </select>
                            <span class="errorValidacion"></span>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="div_resumen_proyecto"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputResumenProyecto" class="form-label">Resumen proyecto</label>
                            <input type="text" class="form-control" id="inputResumenProyecto"
                                value="{{ $proyecto->first()->resumen_proyecto }}" name="resumen_proyecto" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_objetivo_general"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputObjetivoGeneral" class="form-label">Objetivo general</label>
                            <input type="text" class="form-control" id="inputObjetivoProyecto"
                                value="{{ $proyecto->first()->objetivo_general }}" name="objetivo_general" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_objetivos_especificos"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputObjetivosEspecificos" class="form-label">Objetivos especificos</label>
                            @foreach ($objetivos as $objetivo)
                                <div class="input-group mb-3 objetivo-item">
                                    <input type="text" class="form-control" name="objetivos_especificos[]"
                                        value="{{ $objetivo->objetivo_especifico }}" required>
                                    @if ($loop->first)
                                        <a class="btn btn-success btnAgregarObjetivo">+</a>
                                    @else
                                        <a class="btn btn-danger btnEliminarObjetivo">-</a>
                                    @endif
                                </div>
                            @endforeach
                            <span class="errorValidacion"></span>
                        </div>
                        <div id="div_propuesta" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputPropuesta" class="form-label">Propuesta de sostenibilidad</label>
                            <input type="text" class="form-control" id="inputPropuesta" name="propuesta"
                                value="{{ $proyecto->first()->propuesta }}" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="div_impacto" class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label for="inputImpacto" class="form-label">Impacto esperado</label>
                            <input type="text" class="form-control" id="inputImpacto" name="impacto"
                                value="{{ $proyecto->first()->impacto }}" required>
                            <span class="errorValidacion"></span>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div id="tablas">
                            <div id="actividades">
                                @php
                                    $divsActividades = 1;
                                @endphp
                                @foreach ($actividadesCompletas as $actividadC)
                                    <div
                                        class="col-md-12 col-sm-12 justify-content-center align-items-center grupoInput {{ $loop->first ? null : 'actividadAgregada' }} ">
                                        <label for="camposAgregables" class="form-label">Actividades</label>
                                        <table id="camposAgregables">
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
                                                        <input value="{{ $actividadC->descripcion }}" type="text"
                                                            class="form-control" id="inputDescripcion"
                                                            name="descripcion[{{ $divsActividades }}][]" required>
                                                        <span class="errorValidacion"></span>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $cantidad = 1;
                                                        @endphp
                                                        <div class="input-agregar">
                                                            @foreach ($actividades as $actividad => $act)
                                                                @foreach ($act as $ac)
                                                                    @if ($ac->id_actividad_i == $actividadC->id_actividad_i)
                                                                        @if ($loop->first)
                                                                            <div class="campoPrincipal input-group">
                                                                                <input id="{{ $ac->id_actividad }}"
                                                                                    value="{{ $ac->actividad }}"
                                                                                    type="text"
                                                                                    class="form-control agregable"
                                                                                    name="actividades[{{ $divsActividades }}][{{ $cantidad }}][]"
                                                                                    required>
                                                                                <a
                                                                                    class="btnAgregar btn btn-success">+</a>
                                                                            </div>
                                                                        @else
                                                                            <div class="divAgregado input-group">
                                                                                <input id="{{ $ac->id_actividad }}"
                                                                                    value="{{ $ac->actividad }}"
                                                                                    type="text"
                                                                                    class="form-control agregable"
                                                                                    name="actividades[{{ $divsActividades }}][{{ $cantidad }}][]"
                                                                                    required>
                                                                                <a href="#"
                                                                                    class="btn btn-danger btnEliminar">-</a>
                                                                            </div>
                                                                        @endif
                                                                        <span class="errorValidacion"></span>
                                                                    @endif
                                                                    @php $cantidad++ @endphp
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $cantidad = 1;
                                                        @endphp
                                                        <div class="input-agregar">
                                                            @foreach ($entregables as $entregable => $entreg)
                                                                @foreach ($entreg as $entr)
                                                                    @if ($entr->id_actividad_i == $actividadC->id_actividad_i)
                                                                        @if ($loop->first)
                                                                            <div class="campoPrincipal input-group">
                                                                                <input
                                                                                    id="{{ $entr->id_entregable_i }}"
                                                                                    type="text"
                                                                                    class="form-control agregable"
                                                                                    name="entregables[{{ $divsActividades }}][{{ $cantidad }}][]"
                                                                                    value="{{ $entr->entregable }}"
                                                                                    required>
                                                                                <a
                                                                                    class="btnAgregar btn btn-success">+</a>
                                                                            </div>
                                                                        @else
                                                                            <div class="divAgregado input-group">
                                                                                <input
                                                                                    id="{{ $entr->id_entregable_i }}"
                                                                                    type="text"
                                                                                    class="form-control agregable"
                                                                                    name="entregables[{{ $divsActividades }}][{{ $cantidad }}][]"
                                                                                    value="{{ $entr->entregable }}"
                                                                                    required>
                                                                                <a href="#"
                                                                                    class="btn btn-danger btnEliminar">-</a>
                                                                            </div>
                                                                        @endif
                                                                        <span class="errorValidacion"></span>
                                                                    @endif
                                                                    @php $cantidad++ @endphp
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" id="inputEnlace"
                                                            name="enlace_evidencia"
                                                            value="{{ $actividadC->enlace_evidencia }}" required>
                                                        <span class="errorValidacion"></span>
                                                    </td>
                                                    <td>
                                                        <select class="form-control" name="cumplido"
                                                            id="inputCumplido">
                                                            <option value="-1">Seleccione una opcion...</option>
                                                            <option
                                                                {{ $actividadC->cumplido == 'si' ? 'selected' : null }}
                                                                value="si">Si
                                                            </option>
                                                            <option
                                                                {{ $actividadC->cumplido == 'no' ? 'selected' : null }}
                                                                value="no">No
                                                            </option>
                                                        </select>
                                                        <span class="errorValidacion"></span>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $cantidad = 1;
                                                        @endphp
                                                        <div class="input-agregar">
                                                            @foreach ($observaciones as $observacion => $observ)
                                                                @foreach ($observ as $obs)
                                                                    @if ($obs->id_actividad_i == $actividadC->id_actividad_i)
                                                                        @if ($loop->first)
                                                                            <div class="campoPrincipal input-group">
                                                                                <input id="{{ $obs->id_observacion }}"
                                                                                    type="text"
                                                                                    class="form-control agregable"
                                                                                    name="observaciones[{{ $divsActividades }}][{{ $cantidad }}][]"
                                                                                    value="{{ $obs->observacion }}"
                                                                                    required>
                                                                                <a
                                                                                    class="btn btnAgregar btn-success">+</a>
                                                                            </div>
                                                                        @else
                                                                            <div class="divAgregado input-group">
                                                                                <input id="{{ $obs->id_observacion }}"
                                                                                    type="text"
                                                                                    class="form-control agregable"
                                                                                    name="observaciones[{{ $divsActividades }}][{{ $cantidad }}][]"
                                                                                    value="{{ $obs->observacion }}"
                                                                                    required>
                                                                                <a href="#"
                                                                                    class="btn btn-danger btnEliminar">-</a>
                                                                            </div>
                                                                        @endif
                                                                        <span class="errorValidacion"></span>
                                                                    @endif
                                                                    @php $cantidad++ @endphp
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <a id="btnAgregarActividad" class="btn btn-success">+</a>
                                        </table>
                                    </div>
                                    @php $divsActividades++ @endphp
                                @endforeach
                            </div>
                            <br>
                            <hr>
                            <br>
                            @php $divsPresupuestos = 1 @endphp
                            @foreach ($presupuestosCompletos as $presupuesto)
                                <div
                                    class="col-md-12 col-sm-12 justify-content-center align-items-center grupoInput {{ $loop->first ? null : 'presupuestoAgregado' }}">
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
                                                        name="concepto[{{ $divsPresupuestos }}][]"
                                                        value="{{ $presupuesto->concepto }}" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="inputRubro"
                                                        name="rubro[{{ $divsPresupuestos }}][]"
                                                        value="{{ $presupuesto->rubro }}" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="inputUso"
                                                        name="uso_presupuestal[{{ $divsPresupuestos }}][]"
                                                        value="{{ $presupuesto->uso_presupuestal }}" required>
                                                </td>
                                                <td>
                                                    @php
                                                        $cantidad = 1;
                                                    @endphp
                                                    <div class="input-agregar">
                                                        @foreach ($valores as $valor => $val)
                                                            @foreach ($val as $v)
                                                                @if ($v->id_presupuesto_i == $presupuesto->id_presupuesto_i)
                                                                    @if ($loop->first)
                                                                        <div class="campoPrincipal input-group">
                                                                            <input type="text"
                                                                                id="{{ $v->id_valor }}"
                                                                                class="form-control agregable"
                                                                                name="valor_planteado[{{ $divsPresupuestos }}][{{ $cantidad }}][]"
                                                                                value="{{ $v->valor }}" required>
                                                                            <a class="btnAgregar btn btn-success">+</a>
                                                                        </div>
                                                                    @else
                                                                        <div class="divAgregado input-group">
                                                                            <input type="text"
                                                                                id="{{ $v->id_valor }}"
                                                                                class="form-control agregable"
                                                                                name="valor_planteado[{{ $divsPresupuestos }}][{{ $cantidad }}][]"
                                                                                value="{{ $v->valor }}" required>
                                                                            <a href="#"
                                                                                class="btn btn-danger btnEliminar">-</a>
                                                                        </div>
                                                                    @endif
                                                                    <span class="errorValidacion"></span>
                                                                @endif
                                                                @php $cantidad++ @endphp
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <button id="btnAgregarPresupuesto" class="btn btn-success">+</button>
                                    </table>
                                </div>
                                @php $divsPresupuestos++ @endphp
                            @endforeach
                            <br>
                            <hr>
                            <br>
                            <div id="div_estado_proyecto">
                                <label for="inputEstadoProyecto">Estado proyecto</label>
                                <select class="form-control" name="estado_proyecto" id="inputEstadoProyecto">
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="col-md-12 col-sm-12 mt-3">
                                <button id="btnActualizar" class="btn btn-success w-100">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <div id="alertasModificar"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
