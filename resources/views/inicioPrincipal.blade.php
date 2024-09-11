@extends('layouts.plantillaIndex')
@section('title', 'Inicio')
<link rel="stylesheet" href="{{ url('css/incioPrincipal.css') }}">
@stack('styles')
@section('content')

    <div class="cuadradoVistas">
        <div class="welcome-message">
            <img src="img/logoSena.png" height="25px" class="user-image">
            <h1 id="user-name">Nombre del Usuario</h1>
            <div class="quotes">
                <div class="quote">"El único modo de hacer un gran trabajo es amar lo que haces." - Steve Jobs</div>
                <div class="quote">"El éxito es la suma de pequeños esfuerzos repetidos día tras día." - Robert Collier
                </div>
                <div class="quote">"No cuentes los días, haz que los días cuenten." - Muhammad Ali</div>
            </div>
        </div>
    </div>
@endsection
