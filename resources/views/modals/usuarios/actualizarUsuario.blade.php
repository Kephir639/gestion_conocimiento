<div class="modal" id="modalActualizarUsuario">
    <div class="modal-dialog modal-fixed">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Actualizar Usuario</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" value="{{ csrf_token() }}" id="_token">
                    <div class="row mb-3">
                        <div id="div_rol" class="col-md-12">
                            <label for="inputRol" class="form-label">Rol</label>
                            <select id="inputRol" name="idRol" class="form-control">
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id_rol }}"
                                        {{ $rol->id_rol == Auth::user()->idRol ? 'selected' : null }}>
                                        {{ $rol->rol }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="errorValidacion mt-2"></span>
                            <div class="invalid-feedback">Por favor, ingrese el rol.</div>
                        </div>
                        <div id="div_password" class="col-md-6">
                            <label for="inputPassword" class="form-label">password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="inputPassword" name="password"
                                    value="{{ Auth::user()->password }}" required>
                                {{-- <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                    <i class="fa fa-eye"></i>
                                </button> --}}
                                <span class="errorValidacion mt-2"></span>
                            </div>
                            <div class="invalid-feedback">Por favor, ingrese su contraseña.</div>
                        </div>
                        <div id="div_estado_usu" class="col-md-6">
                            <label for="inputEstado" class="form-label">Estado Usuario</label>
                            <select name="estado_usu" id="inputEstado" class="form-control">
                                <option value="1" {{ Auth::user()->estado_usu == 1 ? 'selected' : null }}>Activo
                                </option>
                                <option value="0" {{ Auth::user()->estado_usu == 0 ? 'selected' : null }}>Inactivo
                                </option>
                            </select>
                            <span class="errorValidacion mt-2"></span>
                        </div>
                    </div>
                    <button id="btnActualizar" class="btn btn-success">Enviar</button>
                </form>
                <div id="alertasActualizar">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
