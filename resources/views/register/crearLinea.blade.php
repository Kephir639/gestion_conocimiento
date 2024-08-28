@extends('layouts.plantillaIndex')

@section('title', 'Inicio')

@section('content')

    <div class="cuadradoVistas">
        <div class="indexBackground row">
            <div class="backgroundText">
                <h1>Registrar cargo</h1>
                <form method="POST" action="{{ url('lineas/registrarLineas') }}">
                    @csrf
                    <label for="inputLineas">Linea de investigacion</label>
                    <select name="inputNombreLinea" id="inputNombreLinea">
                        <option value="Coordinador">Coordinador</option>
                        <option value="Convergencia Digital y experimentación">Convergencia Digital y experimentación
                        </option>
                        <option value="Estudios Ambientales Locales">Estudios Ambientales Locales</option>
                        <option value="Ideación y Desarrollo para el Emprendimiento">Ideación y Desarrollo para el
                            Emprendimiento</option>
                        <option value="Integración de Tecnologías Aplicadas en Mecatrónica">Integración de Tecnologías
                            Aplicadas en Mecatrónica</option>
                        <option value="Movilidad Aerea">Movilidad Aerea</option>
                        <option value="Sistemas de Información y comunicación">Sistemas de Información y comunicación
                        </option>
                    </select>
                    <select name="inputEstadoLinea" id="inputEstadoLinea">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
            <div class="backgroundImage"></div>
        </div>
    </div>
@endsection
