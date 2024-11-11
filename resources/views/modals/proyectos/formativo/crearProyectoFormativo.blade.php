<div class="modal" id="modalRegistrarProyectoFormativo">
    <div class="modal-dialog modal-fixed">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Registrar Proyecto Formativo</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        <div id="div_nombre_proyecto"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label class="form-label" for="nombre_proyecto">Nombre Proyecto Formativo</label>
                            <input type="text" class="form-control" id="inputNombreProyecto" name="nombre_proyecto">
                        </div>
                        <div id="div_objetivo_general"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label class="form-label" for="inputObjetivo">Objetivo General</label>
                            <input type="text" class="form-control" id="inputObjetivo" name="objetivo_general">
                        </div>
                        <div id="div_descripcion_problema"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label class="form-label" for="inputProblema">Descripcion problema</label>
                            <input type="text" class="form-control" id="inputProblema" name="descripcion_problema">
                        </div>
                        <div id="div_descripcion_actividad"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label class="form-label" for="inputActividad">Descripcion actividad</label>
                            <input type="text" class="form-control" id="inputActividad" name="descripcion_actividad">
                        </div>
                        <div id="div_experiencia_aprendiz"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label class="form-label" for="inputExperiencia">Experiencia Aprendiz</label>
                            <input type="text" class="form-control" id="inputExperiencia"
                                name="experiencia_aprendiz">
                        </div>
                        <div id="div_dificultad_solucion"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label class="form-label" for="inputDificultadSolucion">Dificultades y soluciones</label>
                            <input type="text" class="form-control" id="inputDificultadSolucion"
                                name="dificultad_solucion">
                        </div>
                        <div id="div_leccion_aprendida"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label class="form-label" for="inputLeccion">Leccion aprendida</label>
                            <input type="text" class="form-control" id="inputLeccion" name="leccion_aprendida">
                        </div>
                        <div id="div_recomendaciones"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label class="form-label" for="inputRecomendaciones">Recomendaciones</label>
                            <input type="text" class="form-control" id="inputRecomendaciones" name="recomendaciones">
                        </div>
                        <div id="div_concluciones"
                            class="col-md-12 col-sm-12 justify-content-center align-items-center">
                            <label class="form-label" for="inputConcluciones">Concluciones</label>
                            <input type="text" class="form-control" id="inputConcluciones" name="concluciones">
                        </div>
                    </div>
                    <button class="btn btn-success" id="btnRegistrar">Enviar</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
