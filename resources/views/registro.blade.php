@extends('layouts.plantillaPresentacion')

@section('title', 'Registro Usuario')



@section('title', 'Registro')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
@endpush

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Registro de Usuario</h2>
        <form action="{{ url('/registro') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" required>
                </div>
                <div class="col-md-6">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tipo_documento" class="form-label">Tipo de Documento</label><br>
                    <select class="form-select" id="tipo_documento" name="tipo_documento" required>
                        <option value="" selected>Seleccione...</option>
                        <option value="CC">Cédula de Ciudadanía</option>
                        <option value="TI">Tarjeta de Identidad</option>
                        <option value="CE">Cédula de Extranjería</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="numero_identificacion" class="form-label">Número de Identificación</label>
                    <input type="text" class="form-control" id="numero_identificacion" name="numero_identificacion"
                        required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="genero" class="form-label">Género</label><br>
                    <select class="form-select" id="genero" name="genero" required>
                        <option value="" selected>Seleccione...</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="O">Otro</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="tipo_poblacion" class="form-label">Tipo de Población</label>
                    <input type="text" class="form-control" id="tipo_poblacion" name="tipo_poblacion" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
                <div class="col-md-6">
                    <label for="celular" class="form-label">Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="departamento" class="form-label">Departamento</label>
                    <select class="form-select" id="departamento" name="departamento" required>
                        <option value="" selected>Seleccione...</option>
                        {{-- @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                    @endforeach --}}
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="municipio" class="form-label">Municipio</label>
                    <select class="form-select" id="municipio" name="municipio" required>
                        <option value="" selected>Seleccione...</option>
                        {{-- @foreach ($municipios as $municipio)
                        <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                    @endforeach --}}
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="profesion" class="form-label">Profesión</label>
                    <select class="form-select" id="profesion" name="profesion">
                        <option value="" selected>Seleccione...</option>
                        {{-- @foreach ($profesiones as $profesion)
                        <option value="{{ $profesion->id }}">{{ $profesion->nombre }}</option>
                    @endforeach --}}
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="maestria" class="form-label">Maestría</label>
                    <select class="form-select" id="maestria" name="maestria">
                        <option value="" selected>Seleccione...</option>
                        {{-- @foreach ($maestrias as $maestria)
                        <option value="{{ $maestria->id }}">{{ $maestria->nombre }}</option>
                    @endforeach --}}
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="doctorado" class="form-label">Doctorado</label>
                    <select class="form-select" id="doctorado" name="doctorado">
                        <option value="" selected>Seleccione...</option>
                        {{-- @foreach ($doctorados as $doctorado)
                        <option value="{{ $doctorado->id }}">{{ $doctorado->nombre }}</option>
                    @endforeach --}}
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="cargo" class="form-label">Cargo</label>
                    <select class="form-select" id="cargo" name="cargo" required>
                        <option value="" selected>Seleccione...</option>
                        {{-- @foreach ($cargos as $cargo)
                        <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                    @endforeach --}}
                    </select>
                </div>
            </div>
            <div class="row mb-3" id="aprendizFields" style="display: none;">
                <div class="col-md-6">
                    <label for="programa_ficha" class="form-label">Nombre del Programa y Ficha</label>
                    <input type="text" class="form-control" id="programa_ficha" name="programa_ficha">
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
                    <label for="contraseña" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                </div>
                <div class="col-md-6">
                    <label for="contraseña_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="contraseña_confirmation"
                        name="contraseña_confirmation" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>
    </div>
    @push('scripts')
        <script src="{{ url('js/registroUsuario.js') }}"></script>
    @endpush
@endsection
