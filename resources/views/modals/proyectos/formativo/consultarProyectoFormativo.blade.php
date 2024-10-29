@extends('layouts.plantillaIndex')

@section('title', 'Proyecto Formativo')

@section('content')
    <h3 class="text-center mt-2">Proyectos formativos</h3>

    <!---Seccion tabla consulta--->
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <table class="table">
            <thead class="tableHeadre">
                <tr class="tituloTabla">
                    <th>NOMBRE PROYECTO</th>
                    <th>FECHA CREACIÓN</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody id="tablebody_lineas">
                @foreach ($listaProyectosFormativos as $pro_formativo)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        {{-- <td>
                            @if ($pro_formativo->estado_grupo == 1)
                                Activo
                            @elseif ($pro_formativo->estado_grupo == 0)
                                Inactivo
                            @endif --}}
                        {{-- </td> --}}
                        <td>
                            @foreach ($controladores as $controlador)
                                @if ($controlador['nombre_controlador'] == 'semilleros')
                                    @foreach ($controlador['funciones'] as $func)
                                        @if ($func['nombre_funcion'] == 'consultar_semilleros')
                                            <button title="Ver proyecto" class="btn p-0"><svg
                                                    xmlns="http://www.w3.org/2000/svg" class="iconoConsultar"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zm-2 13H7v-2h7v2zm3-4H7V9h10v2z">
                                                    </path>
                                                </svg>
                                                </svg></button>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            @foreach ($controladores as $controlador)
                                @if ($controlador['nombre_controlador'] == 'proyecto_formativo')
                                    @foreach ($controlador['funciones'] as $func)
                                        @if ($func['nombre_funcion'] == 'actualizar_proyecto_formativo')
                                            <button title="Modificar proyecto" class="btn p-0"><svg class="iconoModificar"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zM8.999 17H7v-1.999l5.53-5.522 1.999 1.999L8.999 17zm6.473-6.465-1.999-1.999 1.524-1.523 1.999 1.999-1.524 1.523z">
                                                    </path>
                                                </svg></button>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            @foreach ($controladores as $controlador)
                                @if ($controlador['nombre_controlador'] == 'proyecto formativo')
                                    @foreach ($controlador['funciones'] as $func)
                                        @if ($func['nombre_funcion'] == 'validar_integrante')
                                            <button title="Validar integrantes" id="BtnValidar" class="btn p-0"><svg
                                                    xmlns="http://www.w3.org/2000/svg" class="iconoVerificar"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M8 12.052c1.995 0 3.5-1.505 3.5-3.5s-1.505-3.5-3.5-3.5-3.5 1.505-3.5 3.5 1.505 3.5 3.5 3.5zM9 13H7c-2.757 0-5 2.243-5 5v1h12v-1c0-2.757-2.243-5-5-5zm11.294-4.708-4.3 4.292-1.292-1.292-1.414 1.414 2.706 2.704 5.712-5.702z">
                                                    </path>
                                                </svg>
                                                </svg></button>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!---Seccion tabla consulta--->


    <!---Seccion agregar proyecto formativo-->
    <div class="row">
        <div class="col-12 justify-content-center align-items-center d-flex">
            <button class="btn btn-success w-75">
                Crear proyecto productivo
            </button>
        </div>
    </div>
    <!---Seccion agregar proyecto formativo-->




@endsection
