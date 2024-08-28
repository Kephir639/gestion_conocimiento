@extends('layouts.plantillaIndex')
@section('title', 'Inicio')
@section('content')
    <div class="cuadradoVistas">
        <div class="indexBackground row">
            <div class="backgroundText">
                <h1>Editar rol</h1>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ url('/roles/actualizarRol/' . $rol) }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <label for="inputRol" class="form-label">Rol</label>
                    <input type="text" id="inputRol" class="form-control" name="rol_nombre" value="{{ $rol_nombre }}">
                    <label for="inputEstado" class="form-label">Estado</label>
                    <select name="estado" id="estado">
                        <option value="1"{{ $rol_estado == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0"{{ $rol_estado == '0' ? 'selected' : '' }}>Inactivo</option>
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


                    <button type="submit" class="btn btn-success">Actualizar</button>
                </form>
            </div>

            <div class="backgroundImage"></div>
        </div>
    </div>
@endsection
