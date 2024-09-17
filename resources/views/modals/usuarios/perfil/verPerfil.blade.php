@extends('layouts.plantillaIndex')

@section('title', 'Perfil Usuario')

@push('styles')
@endpush

@section('content')
    <div class="container mt-2">
        <h2 class="text-center mb-4">Perfil de Usuario</h2>
        <hr>
        <form action="{{ url('index/user/change_profile') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for=name" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id=name" name="name" value="{{ Auth::user()->name }}"
                        required>
                    <div class="invalid-feedback">Por favor, ingrese sus nombres.</div>
                </div>
                <div class="col-md-6">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos"
                        value="{{ Auth::user()->apellidos }}" required>
                    <div class="invalid-feedback">Por favor, ingrese sus apellidos.</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                    <select class="form-select" id="tipo_documento" name="tipo_documento" required>
                        <option value="-1" selected>Seleccione...</option>
                        <option value="CC" {{ Auth::user()->tipo_documento == 'CC' ? 'selected' : null }}>Cédula de
                            Ciudadanía</option>
                        <option value="TI" {{ Auth::user()->tipo_documento == 'TI' ? 'selected' : null }}>Tarjeta de
                            Identidad</option>
                        <option value="CE" {{ Auth::user()->tipo_documento == 'CE' ? 'selected' : null }}>Cédula de
                            Extranjería</option>
                        <option value="PS" {{ Auth::user()->tipo_documento == 'PS' ? 'selected' : null }}>Pasaporte
                        </option>
                        <option value="PEP" {{ Auth::user()->tipo_documento == 'PEP' ? 'selected' : null }}>Permiso
                            Especial de Permanencia (PEP)</option>
                        <option value="PPT" {{ Auth::user()->tipo_documento == 'PPT' ? 'selected' : null }}>Permiso por
                            Protección Temporal (PPT)</option>
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione un tipo de documento.</div>
                </div>
                <div class="col-md-6">
                    <label for="numero_identificacion" class="form-label">Número de Identificación</label>
                    <input type="text" class="form-control" id="numero_identificacion" name="numero_identificacion"
                        value="{{ Auth::user()->identificacion }}" required>
                    <div class="invalid-feedback">Por favor, ingrese su número de identificación.</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="genero" class="form-label">Género</label>
                    <select class="form-control" id="genero" name="id_genero" required>
                        <option value="" selected>Seleccione...</option>
                        @foreach ($generos as $genero)
                            <option value="{{ $genero->id_genero }}"
                                {{ Auth::user()->id_genero == $genero->id_genero ? 'selected' : null }}>
                                {{ $genero->genero }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione su género.</div>
                </div>

                <div class="col-md-6">
                    <label for="tipo_poblacion" class="form-label">Tipo de Población</label>
                    <select class="form-control" id="tipo_poblacion" name="id_tipo" required>
                        <option value="" selected>Seleccione...</option>
                        @foreach ($tipo_poblaciones as $tipo_poblacion)
                            <option value="{{ $tipo_poblacion->id_tipo_poblacion }}"
                                {{ Auth::user()->id_tipo_poblacion == $tipo_poblacion->id_tipo_poblacion ? 'selected' : null }}>
                                {{ $tipo_poblacion->tipo_poblacion }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione su tipo de población.</div>
                </div>


            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ Auth::user()->email }}" required>
                        {{-- <span class="input-group-text">@sena.com</span> --}}
                    </div>
                    <div class="invalid-feedback">Por favor, ingrese un correo válido.</div>
                </div>
                <div class="col-md-6">
                    <label for="celular" class="form-label">Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular"
                        value="{{ Auth::user()->celular }}" required>
                    <div class="invalid-feedback">Por favor, ingrese su número de celular.</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="departamento" class="form-label">Departamento</label>
                    <select class="form-select" id="departamento" name="id_departamento" required>
                        <option value="" selected>Seleccione...</option>
                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id_departamento }}"
                                {{ Auth::user()->id_departamento == $departamento->id_departamento ? 'selected' : null }}>
                                {{ $departamento->departamento }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione un departamento.</div>
                </div>

                <div class="col-md-6">
                    <label for="municipio" class="form-label">Municipio</label>
                    <select class="form-select" id="municipio" name="id_municipio" required>

                        <option value="" selected>Seleccione...</option>
                        <!-- Los municipios se cargarán dinámicamente aquí -->
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione un municipio.</div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion"
                        value="{{ Auth::user()->direccion }}" required>
                    <div class="invalid-feedback">Por favor, ingrese su dirección.</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="cargo" class="form-label">Cargo</label>
                    <select class="form-select" id="cargo" name="id_cargo" required>
                        <option value="" selected>Seleccione...</option>
                        @foreach ($cargos as $cargo)
                            <option value="{{ $cargo->id_cargo }}"
                                {{ Auth::user()->id_cargo == $cargo->id_cargo ? 'selected' : null }}>
                                {{ $cargo->nombre_cargo }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione un cargo.</div>
                </div>
            </div>

            <div class="row mb-3 instructorFields" style="display: none;">
                <div class="col-md-4">
                    <label for="profesion" class="form-label">Profesión</label>
                    <select class="form-select" id="profesion" name="id_profesion">
                        <option value="" selected>Seleccione...</option>
                        @foreach ($profesiones as $profesion)
                            <option value="{{ $profesion->id_profesiones }}"
                                {{ Auth::user()->id_profesion == $profesion->id_profesiones ? 'selected' : null }}>
                                {{ $profesion->nombre_profesion }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione una profesión.</div>
                </div>
                <div class="col-md-4">
                    <label for="maestria" class="form-label">Maestría</label>
                    <select class="form-select" id="maestria" name="id_maestria">
                        <option value="" selected>Seleccione...</option>
                        @foreach ($maestrias as $maestria)
                            <option value="{{ $maestria->id_maestria }}"
                                {{ Auth::user()->id_maestria == $maestria->id_maestria ? 'selected' : null }}>
                                {{ $maestria->nombre_maestria }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione una maestría.</div>
                </div>
                <div class="col-md-4">
                    <label for="doctorado" class="form-label">Doctorado</label>
                    <select class="form-select" id="doctorado" name="id_doctorado">
                        <option value="" selected>Seleccione...</option>
                        @foreach ($doctorados as $doctorado)
                            <option value="{{ $doctorado->id_doctorado }}"
                                {{ Auth::user()->id_doctorado == $doctorado->id_doctorado ? 'selected' : null }}>
                                {{ $doctorado->nombre_doctorado }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione un doctorado.</div>
                </div>
            </div>


            <div class="row mb-3" id="aprendizFields" style="display: none;">
                <div class="col-md-6">
                    <label for="Nombre_programa" class="form-label">Nombre del Programa</label>
                    <input type="text" class="form-control" id="Nombre_programa" name="Nombre_programa"
                        value="{{ Auth::user()->nombre_programa }}">
                    <div class="invalid-feedback">Por favor, ingrese el nombre del programa</div>
                </div>
                <div class="col-md-6">
                    <label for="ficha" class="form-label">Número de ficha</label>
                    <input type="text" class="form-control" id="ficha" name="ficha"
                        value="{{ Auth::user()->ficha }}">
                    <div class="invalid-feedback">Por favor, ingrese el número de la ficha</div>
                </div>
                <div class="col-md-6">
                    <label for="semillero" class="form-label">Semillero de Investigación</label>
                    <select class="form-select" id="semillero" name="semillero">
                        <option value="" selected>Seleccione...</option>
                        {{-- @foreach ($semilleros as $semillero)
                            <option value="{{ $semillero->id }}">{{ $semillero->nombre }}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label">password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password"
                            value="{{ Auth::user()->password }}" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <div class="invalid-feedback">Por favor, ingrese su password.</div>
                </div>

                {{-- <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="contraseña_confirmation"
                        name="contraseña_confirmation" required>
                    <div class="invalid-feedback">Por favor, confirme su contraseña.</div>
                </div> --}}
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg mt-3">Registrar</button>
            </div>
        </form>
    </div>
@endsection
