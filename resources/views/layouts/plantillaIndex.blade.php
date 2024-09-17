<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/plantilla.css') }}">
    {{-- <link rel="stylesheet" href="{{ url('libraries/select2-4.0.13/dist/css/select2.css') }}"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
        integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('styles')

</head>

<body>
    <div class="app">
        <div id="sidebar" class="">
            <div class="h-100">
                <div class="sidebar-logo p-2">
                    <img class="logoSenova" src="{{ asset('iconos/Sennova.png') }}" alt="Senova">
                </div>
                <ul class="list-unstyled mb-0 ml-0 pl-0 flex-grow-1">
                    <div class="d-flex align-items-center justify-content-end p-3 pe-1">
                        <li class="sidebar-header">

                            <button class="btn btnToggler p-2 mr-1" id="sidebar-toggle-close" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="iconoToggler toggler-sidebar"
                                    viewBox="0 0 24 24">
                                    <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
                                </svg>
                            </button>
                    </div>
                    <li class="mt-2">
                        <a href="/index" class="sidebar-tabb-drop sidebar-link px-3 py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="iconos" viewBox="0 0 24 24">
                                <path
                                    d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z">
                                </path>
                            </svg>
                            Inicio
                        </a>
                    </li>
                    @foreach ($controladores as $controlador)
                        @foreach ($controlador['funciones'] as $func)
                            @if (Str::contains($func['nombre_funcion'], 'consultar'))
                                <li class="sidebar-item">
                                    <a href="/index/{{ $controlador['nombre_controlador'] }}/{{ $func['nombre_funcion'] }}"
                                        id="tab_{{ $controlador['nombre_controlador'] }}"
                                        class="sidebar-tabb sidebar-link collapsed px-3 py-2" {{-- data-bs-target="#{{ $contr['nombre_controlador'] }}" data-bs-toggle="collapse" --}}
                                        aria-expanded="false">{!! html_entity_decode($controlador['icono']) !!}{{ $controlador['display_controlador'] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endforeach
                </ul><br>
            </div>
        </div>
        <nav class="navbar navPerz">
            <button class="btn btnToggler p-2" id="sidebar-toggle" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="iconoToggler toggler-sidebar" viewBox="0 0 24 24">
                    <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
                </svg>
            </button>
            {{-- @if (Auth::user()->idRol == 1)
                <div class="notifycon mr-5"><svg xmlns="http://www.w3.org/2000/svg" class="mt-2" width="24"
                        height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1)">
                        <path
                            d="M12 10c1.151 0 2-.848 2-2s-.849-2-2-2c-1.15 0-2 .848-2 2s.85 2 2 2zm0 1c-2.209 0-4 1.612-4 3.6v.386h8V14.6c0-1.988-1.791-3.6-4-3.6z">
                        </path>
                        <path
                            d="M19 2H5c-1.103 0-2 .897-2 2v13c0 1.103.897 2 2 2h4l3 3 3-3h4c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm-5 15-2 2-2-2H5V4h14l.002 13H14z">
                        </path>
                    </svg><span>{{ $usuariosPendientes }}</span></div>
                <div class="notify-box mr-3 mt-4 p-1" id="box">
                    <h2>Usuario pendientes para asignacion de rol <span>{{ $usuariosPendientes }}</span></h2>
                </div>
            @endif --}}
            <div class="nabvar-collapse navbar">
                <ul class="navbar-nav ml-auto">
                </ul>
                <li class="nav-item dropdown">
                    <a href="#" data-bs-target="dropdownPerfil" class="nav-icon pe-md-0" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="iconos" viewBox="0 0 24 24">
                            <path
                                d="M20 4H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zM8.715 8c1.151 0 2 .849 2 2s-.849 2-2 2-2-.849-2-2 .848-2 2-2zm3.715 8H5v-.465c0-1.373 1.676-2.785 3.715-2.785s3.715 1.412 3.715 2.785V16zM19 15h-4v-2h4v2zm0-4h-5V9h5v2z">
                            </path>
                        </svg>
                    </a>
                    <ul class="dropdown-menu menuD dropdown-menu-end" id="dropdownPerfil">
                        <li class="navbar-item"><span class="dropdown-item text-center">Nombre
                                Usuario</span>
                        </li>
                        <li>
                            <hr class="dropdown divider division my-1">
                        </li>
                        <li class="navbar-item"><a href="/index/user/view_profile"
                                class="dropdown-item item-perfil w-100 text-center">Ver perfil</a>
                        </li>
                        <li id="logoutBtn" class="navbar-item"><a href="/logout"
                                class="dropdown-item item-perfil w-100 text-center">Cerrrar
                                Sesión</a>
                        </li>
                    </ul>
                </li>
            </div>
        </nav>
        <div class="main">
            <div class="bg"></div>
            <div class="bg bg2"></div>
            <div class="bg bg3"></div>
            <div class="cuadradoPlantilla px-3">
                <div class="cuadradoVistas">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('libraries/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ url('libraries/popper.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ url('libraries/select2-4.0.13/dist/js/select2.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
        integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ url('js/indexSidebar.js') }}"></script>

    @stack('scripts')

</body>

</html>
