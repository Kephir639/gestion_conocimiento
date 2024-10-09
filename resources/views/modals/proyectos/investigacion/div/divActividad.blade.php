<div class="col-md-12 col-sm-12 justify-content-center align-items-center grupoInput actividadAgregada">
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
                <div class="grupoInput">
                    <td>
                        <input type="text" class="form-control simple" id="inputDescripcion"
                            name="descripcion[{{ $contador_actividad }}][]" required>
                    </td>
                    <td>
                        <div class="input-agregar">
                            <div class="campo_principal input-group">
                                <input type="text" class="form-control agregable"
                                    name="actividades[{{ $contador_actividad }}][1][]" required><a href="#"
                                    class="btnAgregar p-2 btn btn-success">+</a href="#">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="input-agregar">
                            <div class="campo_principal input-group">
                                <input type="text" class="form-control agregable"
                                    name="entregables[{{ $contador_actividad }}][1][]" required><a href="#"
                                    class="btnAgregar p-2 btn btn-success">+</a href="#">
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type="text" class="form-control simple" id="inputEnlace"
                            name="enlace_evidencia[{{ $contador_actividad }}][]" required>
                    </td>
                    <td>
                        <select class="form-control simple" name="cumplido[{{ $contador_actividad }}][]"
                            id="inputCumplido">
                            <option value="-1">Seleccione una opcion...</option>
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
                    </td>
                    <td>
                        <div class="input-agregar">
                            <div class="campo_principal input-group">
                                <input type="text" class="form-control agregable"
                                    name="observaciones[{{ $contador_actividad }}][1][]" required><a href="#"
                                    class="btnAgregar btn btn-success">+</a href="#">
                            </div>
                        </div>
                    </td>
                </div>
            </tr>
        </tbody>
        <button id="btnEliminarActividad" class="btn btn-danger">-</button>
    </table>
</div>
