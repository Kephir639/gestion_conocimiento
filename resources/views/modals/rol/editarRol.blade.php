<div class="modal" id="modalRegistrarRedes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Actualizar Rol</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" value="{{ csrf_token() }}" id="_token">
                    <label for="inputNombreRol" class="form-label">Rol</label>
                    <input type="text" id="inputNombreRol" class="form-control" name="nombre_rol">
                    <label for="inputEstadoRol" class="form-label">Estado</label>
                    <select name="estado_rol" id="inputEstadoRol">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select><br>
                    <div class="row">
                        @foreach ($funciones as $key => $funcion)
                            @if (!in_array($funcion->controlador, $array_existencia))
                                @if ($key != 0)
                    </div>
                    @endif
                    <?php $array_existencia[] = $funcion->controlador; ?>
                    <div class="col-md-6 col-sm-12 text-center">
                        <h3>{{ $funcion->controlador }}</h3>
                        @endif
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="checkFunciones[]" id="inlineCheckbox1"
                                value="{{ $funcion->id }}"
                                {{ in_array($funcion->id, $permisoIds) ? 'checked' : '' }}><label>{{ $funcion->nombre }}</label><br>

                        </div><br>
                        @endforeach
                    </div>
                    <button id="btnActualizar" class="btn btn-success">Actualizar</button>
                </form>
                <div id="alertasActualizar"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
