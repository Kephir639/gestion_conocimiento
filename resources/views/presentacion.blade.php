@extends('layouts.plantillaPresentacion')

@section('title', 'Gestión de Conocimiento')
<link rel="stylesheet" href="{{ asset('css/juan.css') }}">
@stack('styles')

@section('content')
    <div class="clase11">
        <div class="container-fluid">
            <div class="row d-flex align-items-stretch justify-content-center">
                <!-- Sección del Carrusel -->
                <div class="col-md-7 d-flex flex-column justify-content-center align-items-center section-carousel">
                    <div class="slick-carousel shadow-lg rounded">
                        <div><img src="img/Semillero_geinci.png" class="d-block w-100 rounded" alt="First slide"></div>
                        <div><img src="img/Semillero_sinco.png" class="d-block w-100 rounded" alt="Second slide"></div>
                        <div><img src="img/Semillero_ambiental.png" class="d-block w-100 rounded" alt="Third slide"></div>
                        <div><img src="img/Semillero_codex.png" class="d-block w-100 rounded" alt="Fourth slide"></div>
                        <div><img src="img/Semillero_Siide.png" class="d-block w-100 rounded" alt="Fifth slide"></div>
                        <div><img src="img/Semillero_siitam.png" class="d-block w-100 rounded" alt="Sixth slide"></div>
                        <div><img src="img/Semillero_sissmo.png" class="d-block w-100 rounded" alt="Seventh slide"></div>
                        <div><img src="img/Semillero_sima.png" class="d-block w-100 rounded" alt="Eighth slide"></div>
                    </div>
                </div>

                <!-- Sección de los Botones dentro de una Card -->
                <div class="col-md-5 d-flex flex-column justify-content-center align-items-center section-buttons">
                    <div class="custom-card">
                        <h2 class="mb-4">Bienvenido</h2>
                        <div class="btn-container d-flex flex-column align-items-center">
                            <a href="{{ url('/login') }}" class="btn btn-primary btn-animate mb-3">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                            </a>
                            <a href="{{ url('/registro') }}" class="btn btn-secondary btn-animate">
                                <i class="fas fa-user-plus"></i> Registrarse 
                            </a>
                        </div>
                    </div>
                </div>
                

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="{{ asset('js/scriptPresentacion.js') }}"></script>
    <script src="{{ asset('js/animacionBotones.js') }}"></script>
@endsection
