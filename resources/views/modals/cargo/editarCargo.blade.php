@extends('layouts.plantillaIndex')
@section('title', 'Inicio')
@section('content')
    <div class="cuadradoVistas">
        <div class="indexBackground row">
            <div class="backgroundText">
                <h1>Editar cargo</h1>
                <form action="{{ url('/cargos/actualizarCargo/' . $cargo) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <label for="inputRol" class="form-label">Cargo</label>
                    <input type="text" id="inputCargo" class="form-control" name="cargo_nombre"
                        value="{{ $cargo_nombre }}">
                    <label for="inputEstado" class="form-label">Estado</label>
                    <select name="estado" id="estado">
                        <option value="1"{{ $cargo_estado == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0"{{ $cargo_estado == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select><br>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </form>
            </div>
            <div class="backgroundImage"></div>
        </div>
    </div>
@endsection
