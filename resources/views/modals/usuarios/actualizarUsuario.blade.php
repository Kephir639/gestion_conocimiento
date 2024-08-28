@extends('layouts.plantillaIndex')

@section('title', 'Inicio')

@section('content')

    <form action="{{ url('home/usuarios/actualizar/procesarActualizacion') }}" method="post">
        @csrf
        <div>
            <label for="inputRol">Rol</label>
            <input type="number" min="0" id="inputRol" name="id_rol" placeholder="Ingrese sus nombres">
        </div>
        <div>
            <label for="inputNombres">Nombres</label>
            <input type="text" id="inputNombres" name="nombres" placeholder="Ingrese sus nombres">
        </div>
        <div>
            <label for="inputApellidos">Apellidos</label>
            <input type="text" id="inputApellidos" name="apellidos" placeholder="Ingrese sus apellidos">
        </div>
        <div>
            <label for="inputTipoDocumento">Tipo de Documento</label>
            <input type="text" id="inputTipoDocumento" name="tipoDocumento" placeholder="Ingrese su Tipo de documento">
        </div>
        <div>
            <label for="inputDocumento">Numero de Documento</label>
            <input type="number" min="0" id="inputDocumento" name="documento" placeholder="Ingrese sus nombres">
        </div>
        <div>
            <label for="inputGenero">Genero</label>
            <input type="number" id="inputGenero" name="id_genero">
        </div>
        <div>
            <label for="inputTipo">Tipo de Poblacion</label>
            <input type="number" id="inputTipo" name="id_tipo_poblacion">
        </div>
        <div>
            <label for="inputCorreo">Correo</label>
            <input type="text" id="inputCorreo" name="correo" placeholder="Ingrese sus nombres">
        </div>
        <div>
            <label for="inputCelular">Numero celular</label>
            <input type="text" id="inputCelular" name="celular" placeholder="Ingrese sus nombres">
        </div>
        {{-- <div>
            <label for="inputDepartamentos">Departamento</label>
            <input type="text" id="inputDepartamentos" name="departamento" placeholder="Ingrese sus nombres">
        </div> --}}
        <div>
            <label for="inputMunicipio">Municipio</label>
            <input type="number" id="inputMunicipio" name="id_municipio">
        </div>
        <div>
            <label for="inputDireccion">Direccion</label>
            <input type="text" id="inputDireccion" name="direccion" placeholder="Ingrese sus nombres">
        </div>
        {{-- <div>
            <label for="inputProfesion">Profesion</label>
            <input type="text" id="inputProfesion" name="profesion" placeholder="Ingrese sus nombres">
        </div>
        <div>
            <label for="inputMaestria">Maestria</label>
            <input type="text" id="inputMaestria" name="maestria" placeholder="Ingrese sus nombres">
        </div>
        <div>
            <label for="inputDoctorado">Doctorado</label>
            <input type="text" id="inputDoctorado" name="doctorado" placeholder="Ingrese sus nombres">
        </div> --}}
        <div>
            <label for="inputCargo">Cargo</label>
            <input type="number" id="inputCargo" name="id_cargo">
        </div>
        <div>
            <label for="inputFicha">Nombre del programa y ficha</label>
            <input type="number" id="inputFicha" name="id_programa">
        </div>
        {{-- <div>
            <label for="inputSemillero">Semillero de Investigacion</label>
            <input type="text" id="inputSemillero" name="semillero" placeholder="Ingrese sus nombres">
        </div> --}}
        <div>
            <label for="inputEstado">Estado</label>
            <input type="number" name="estado_usu" id="inputEstado">
        </div>
        <div>
            <label for="inputContra">Contraseña</label>
            <input type="password" id="inputContra" name="contraseña" placeholder="Ingrese sus nombres">
        </div>
        <button type="submit">Actualizar</button>
    </form>

@endsection
