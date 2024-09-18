$(document).ready(function () {
    let button = '';
    
    // Método para abrir el modal de editar semillero
    $('.btnEditarSemillero').on('click', function () {
        button = $(this);
        let nombreSemillero = $(this).parents('tr').find('td:eq(0)').text().trim();
        let descripcionSemillero = $(this).parents('tr').find('td:eq(1)').text().trim();
        let coordinadorSemillero = $(this).parents('tr').find('td:eq(2)').text().trim();
        
        $.ajax({
            type: 'GET',
            url: 'showModalActualizarSemillero',
            success: function (data) {
                $('#ModalSection').html(data);

                $('#inputNombreSemillero').val(nombreSemillero);
                $('#inputDescripcionSemillero').val(descripcionSemillero);
                $('#inputCoordinadorSemillero').val(coordinadorSemillero);

                $('#modalModificarSemillero').modal('show');
            }
        });
    });

    // Método para abrir el modal de registrar semillero
    $('#BtnRegistrarSemillero').on('click', function () {
        button = $(this);
        $.ajax({
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                $('#ModalSection').html(data);
                $('#modalRegistrarSemillero').modal('show');
            }
        });
    });

    // Método para actualizar un semillero
    $('#formModificarSemillero').submit(function (e) {
        e.preventDefault();
        let nombre_old = button.parents('tr').find('td:eq(0)').text().trim();

        let nombre = $('#inputNombreSemillero').val();
        let descripcion = $('#inputDescripcionSemillero').val();
        let coordinador = $('#inputCoordinadorSemillero').val();
        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "actualizarSemillero",
            data: {
                '_token': token,
                'nombre_semillero': nombre,
                'nombre_semillero_old': nombre_old,
                'descripcion_semillero': descripcion,
                'coordinador_semillero': coordinador
            },
            success: function (data) {
                $('#alertasModificarSemillero').html(data);
                button.parents('tr').find('td:eq(0)').text(nombre);
                button.parents('tr').find('td:eq(1)').text(descripcion);
                button.parents('tr').find('td:eq(2)').text(coordinador);
            }
        });
    });

    // Método para registrar un nuevo semillero
    $(document).on ('click','#btnRegistrar',function (e) {
        e.preventDefault();
        let nombre = $('#inputNombreSemillero').val();
        let descripcion = $('#inputDescripcionSemillero').val();
        let coordinador = $('#inputCoordinadorSemillero').val();
        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "registrarSemillero",
            data: {
                '_token': token,
                'nombre_semillero': nombre,
                'descripcion_semillero': descripcion,
                'coordinador_semillero': coordinador
            },
            success: function (data) {
                // Actualizar la tabla de semilleros
                $('#tablebody_semilleros').html(data.tabla);

                // Mostrar alerta
                $('#alertasRegistrarSemillero').html(data.alerta);
            }
        });
    });
});
