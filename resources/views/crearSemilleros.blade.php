@extends('layouts.plantillaIndex')
@section('title', 'Crear Semilleros')
<link rel="stylesheet" href="{{ asset('css/semilleros/crearSemilleros.css') }}">
@stack('styles')
@section('content')
        <div class="container">
            <h2>Crear Semillero</h2>
            <form action="{{ url('/index/semilleros/crear_semillero') }}" method="POST">
                @csrf
                <!-- Nombre del Semillero -->
                <div class="form-group">
                    <label for="nombre_semillero">Nombre del Semillero</label>
                    <input type="text" id="nombre_semillero" name="nombre_semillero" class="form-control" required>
                </div>
    
                <!-- Iniciales del Semillero -->
                <div class="form-group">
                    <label for="iniciales_semillero">Iniciales del Semillero</label>
                    <input type="text" id="iniciales_semillero" name="iniciales_semillero" class="form-control" required>
                </div>
    
                <!-- Fecha de Creación -->
                <div class="form-group">
                    <label for="fecha_creacion">Fecha de Creación</label>
                    <input type="date" id="fecha_creacion" name="fecha_creacion" class="form-control" required>
                </div>
    
                <!-- Misión -->
                <div class="form-group">
                    <label for="mision">Misión</label>
                    <textarea id="mision" name="mision" class="form-control" rows="4" required></textarea>
                </div>
    
                <!-- Visión -->
                <div class="form-group">
                    <label for="vision">Visión</label>
                    <textarea id="vision" name="vision" class="form-control" rows="4" required></textarea>
                </div>
    
                <!-- Objetivo General -->
                <div class="form-group">
                    <label for="objetivo_general">Objetivo General</label>
                    <input type="text" id="objetivo_general" name="objetivo_general" class="form-control" required>
                </div>
    
                <!-- Objetivos Específicos -->
                <div class="form-group">
                    <label for="objetivos_especificos">Objetivos Específicos</label>
                    <textarea id="objetivos_especificos" name="objetivos_especificos" class="form-control" rows="4" required></textarea>
                </div>
    
                <!-- Grupo -->
                <div class="form-group">
                    <label for="id_grupo">Grupo</label>
                    <input type="number" id="id_grupo" name="id_grupo" class="form-control" required>
                </div>
    
                <!-- Plan -->
                <div class="form-group">
                    <label for="id_plan">Plan</label>
                    <input type="number" id="id_plan" name="id_plan" class="form-control" required>
                </div>
    
                <!-- Estado -->
                <div class="form-group">
                    <label for="estado_semillero">Estado</label>
                    <input type="number" id="estado_semillero" name="estado_semillero" class="form-control" required>
                </div>
    
                <button type="submit" id="btnCrearSemillero" class="btn btn-primary">Crear Semillero</button>
            </form>
        </div>

@endsection
