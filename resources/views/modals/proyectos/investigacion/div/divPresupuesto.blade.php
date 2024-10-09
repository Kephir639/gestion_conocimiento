<div class="col-md-12 col-sm-12 justify-content-center align-items-center presupuestoAgregado grupoInput">
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
                    <input type="text" class="form-control simple" id="inputConcepto"
                        name="concepto[{{ $contador_presupuesto }}][]" required>
                </td>
                <td>
                    <input type="text" class="form-control simple" id="inputRubro"
                        name="rubro[{{ $contador_presupuesto }}][]" required>
                </td>
                <td>
                    <input type="text" class="form-control simple" id="inputUso"
                        name="uso_presupuestal[{{ $contador_presupuesto }}][]" required>
                </td>
                <td>
                    <div class="input-agregar">
                        <div class="campo_principal input-group">
                            <input type="text" class="form-control agregable"
                                name="valor_planteado[{{ $contador_presupuesto }}][1][]" required><button
                                class="btnAgregar btn btn-success">+</button>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
        <button id="btnEliminarPresupuesto" class=" btn btn-danger">-</button>
    </table>
</div>
