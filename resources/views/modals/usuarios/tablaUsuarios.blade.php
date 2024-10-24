@foreach ($listaUsuarios as $usuario)
    <tr>
        <td>{{ $usuario->id }}</td>
        <td>{{ $usuario->tipo_documento }}</td>
        <td>{{ $usuario->identificacion }}</td>
        <td>{{ $usuario->name }}</td>
        <td>{{ $usuario->apellidos }}</td>
        <td>{{ $usuario->email }}</td>
        <td>{{ $usuario->rol }}</td>
        <td>{{ $usuario->estado_usu == 1 ? 'Activo' : 'Inactivo' }}</td>
        <td class="justify-content-center align-items-center ">
            @foreach ($controladores as $controlador)
                @if ($controlador['nombre_controlador'] == 'usuarios')
                    @foreach ($controlador['funciones'] as $func)
                        {{-- @dump($controlador['funciones']) --}}
                        @if ($func['nombre_funcion'] == 'actualizar_usuarios')
                            <button title="Modificar rol" class="btn p-0">
                                <svg class="iconoModificar" width="34" height="34" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zM8.999 17H7v-1.999l5.53-5.522 1.999 1.999L8.999 17zm6.473-6.465-1.999-1.999 1.524-1.523 1.999 1.999-1.524 1.523z">
                                    </path>
                                </svg>
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </td>
    </tr>
@endforeach
