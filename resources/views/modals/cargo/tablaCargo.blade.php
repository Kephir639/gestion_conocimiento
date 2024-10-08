@foreach ($listaCargos as $cargos)
    <tr>
        <td>{{ $cargos->nombre_cargos }}</td>
        <td>
            @if ($cargos->estado_cargos == 1)
                Activo
            @elseif ($cargos->estado_cargos == 0)
                Inactivo
            @endif
        </td>
        <td>
            @foreach ($controladores as $controlador)
                @if ($controlador['nombre_controlador'] == 'cargos')
                    @foreach ($controlador['funciones'] as $func)
                        @if ($func['nombre_funcion'] == 'modificar_cargo')
                            <button title="Modificar Cargo" class="btn iconoModificar p-0"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zM8.999 17H7v-1.999l5.53-5.522 1.999 1.999L8.999 17zm6.473-6.465-1.999-1.999 1.524-1.523 1.999 1.999-1.524 1.523z">
                                    </path>
                                </svg></button>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </td>
    </tr>
@endforeach
