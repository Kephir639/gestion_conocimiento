@extends('layouts.plantillaIndex')
@section('title', 'Inicio')
@section('content')
    <div class="cuadradoVistas">
        <div class="indexBackground row">
            <div class="backgroundText">
                <h1>Editar linea de investigación</h1>
                <form action="{{ url('/lineas/actualizarLinea/' . $lineas) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <label for="inputRol" class="form-label">Linea de investigación</label>
                    <input type="text" id="inputLinea" class="form-control" name="linea_nombre"
                        value="{{ $linea_nombre }}">
                    <label for="inputEstado" class="form-label">Estado</label>
                    <select name="estado" id="estado">
                        <option value="1"{{ $linea_estado == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0"{{ $linea_estado == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select><br>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </form>
            </div>
            <div class="backgroundImage"></div>
        </div>
    </div>
@endsection
