<div class="modal" id="modalRegistrarRol">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Registrar Rol</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mt-3">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token">
                        <label for="inputNombreRol" class="form-label">Rol</label>
                        <select name="nombre_rol" id="inputNombreRol">
                            <option value="Administrador">Administrador</option>
                            <option value="Aprendiz">Aprendiz</option>
                            <option value="Auditor">Auditor</option>
                            <option value="Coordinador">Coordinador</option>
                            <option value="Dinamizador SENNOVA">Dinamizador SENNOVA</option>
                            <option value="Instructor investigador">Instructor investigador</option>
                            <option value="Líder de semillero">Líder de semillero</option>
                            <option value="Líder de proyecto">Líder de proyecto</option>
                        </select>
                        <br>
                        <label for="inputPermisos" class="form-label">Permisos</label><br>
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
                                <input class="form-check-input" type="checkbox" name="checkFunciones[]"
                                    id="inlineCheckbox1"
                                    value="{{ $funcion->id }}">{{ $funcion->nombre }}<label></label><br>
                            </div><br>
                            @endforeach
                        </div>
                        <div class="col-md-12 col-sm-12 mt-3">
                            <button id="btnRegistrar" class="btn btn-success w-100">Enviar</button>
                        </div>
                    </div>
                </form>
                <div id="alertasRegistrar"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
            <div class="backgroundImage"></div>
        </div>
    </div>
</div>
