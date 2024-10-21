<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/bienvenida.css') }}">
    @stack('styles')
</head>

<body>
    <div class="main-content">
        <!-- Banner -->
        <div class="banner-container">
            <img src="{{ url('/img/baner.png') }}" alt="Banner">
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="fas fa-home"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#modalSobreNosotros">
                            <i class="fas fa-info-circle"></i> Sobre Nosotros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#modalContacto">
                            <i class="fas fa-envelope"></i> Contacto
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div>
            @yield('content')
        </div>

        <!-- Modal Sobre Nosotros -->
        <div class="modal fade" id="modalSobreNosotros" tabindex="-1" role="dialog"
            aria-labelledby="modalSobreNosotrosLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalSobreNosotrosLabel" style="color: #222222;">Sobre Nosotros</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="color: #222222;">Somos una organización dedicada a fomentar el conocimiento y el
                            aprendizaje colaborativo.</p>
                        <div class="embed-responsive embed-responsive-16by9">

                            <iframe class="embed-responsive-item"
                                src="https://www.youtube.com/embed/2TG9nyCkxDg?si=C8H_hVsgk5gbsOND"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Contacto -->
        <div class="modal fade" id="modalContacto" tabindex="-1" role="dialog" aria-labelledby="modalContactoLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalContactoLabel" style="color: #222222;">Contacto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p style="color: #222222;">¡Contáctanos! Si tienes alguna pregunta o sugerencia, no dudes en
                            escribirnos a contacto@sennova.org o llámanos al +123456789.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-team">
                <div class="team-member">
                    <img src="{{ url('img/logoSena.png') }}" alt="Subdirector">
                    <p><i class="fas fa-user-tie"></i> Subdirector: Alex Amed Valencia</p>
                </div>
                <div class="team-member">
                    <img src="{{ url('img/nestor.png') }}" alt="Coordinador Misional">
                    <p><i class="fas fa-user-tie"></i> Coordinador Misional: Nestor Espitia</p>
                </div>
                <div class="team-member">
                    <img src="{{ url('img/mecatronicalogo.png') }}" alt="Coordinador Académico A">
                    <p><i class="fas fa-user-tie"></i> Diseño y Mantenimiento Mecatrónico</p>
                </div>
                <div class="team-member">
                    <img src="{{ url('img/digital.png') }}" alt="Coordinador Académico B">
                    <p><i class="fas fa-user-tie"></i> Comunicación Digital</p>
                </div>
                <div class="team-member">
                    <img src="{{ url('img/trasversalidad.png') }}" alt="Coordinador Académico C">
                    <p><i class="fas fa-user-tie"></i>Transversalidad Tecnológica</p>
                </div>
                <div class="team-member">
                    <img src="{{ url('img/vestuario.png') }}" alt="Coordinador Académico D">
                    <p><i class="fas fa-user-tie"></i> Vestuario Inteligente</p>
                </div>
            </div>
            <div class="footer-info">
                <p><i class="fas fa-map-marker-alt"></i> Sennova&nbsp;&nbsp;/&nbsp;Dirección: Calle 72k # 26J-97</p>
                <p>&copy; 2024 Gestion del Conocimiento. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Script dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('js/particles.min.js') }}"></script>
    <script src="{{ url('js/presentacion.js') }}"></script>
    <script src="{{ url('js/departamentos.js') }}"></script>
    <script src="{{ url('js/profesiones.js') }}"></script>

    @stack('scripts')
    <!-- Initialize Slick Carousel -->
    <script>
        $(document).ready(function() {
            $('.slick-carousel').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                adaptiveHeight: true,
                autoplay: true,
                autoplaySpeed: 3000,
                fade: true,
                cssEase: 'linear'
            });

            $('#modalSobreNosotros').on('hide.bs.modal', function() {
                var $this = $(this).find('iframe'),
                    tempSrc = $this.attr('src');
                $this.attr('src', "");
                $this.attr('src', tempSrc);
            });
        });
    </script>

    <script>
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '<ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>',
            });
        @endif

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        @endif
    </script>

</body>

</html>
