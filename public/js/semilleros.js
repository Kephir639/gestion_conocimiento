$(document).ready(function () {
    let button = '';

    // Open modal for modifying Semillero
    $(document).on('click', '.iconoModificarSemillero', function () {
        button = $(this);
        
        // Get the values from the selected row in the table
        let nombreSemillero = $(button).parents('tr').find('td:eq(0)').text().trim();
        let iniciales = $(button).parents('tr').find('td:eq(1)').text().trim();
        let liderSemillero = $(button).parents('tr').find('td:eq(2)').text().trim();

        // Set the values into the modal inputs
        $('#ModalModificarSemilleros').find('#inputNombreSemillero').val(nombreSemillero);
        $('#ModalModificarSemilleros').find('#inputIniciales').val(iniciales);
        $('#ModalModificarSemilleros').find('#inputLider').val(liderSemillero);

        // Show the modal
        $('#ModalModificarSemilleros').modal('show');
    });

    // Handle the form submission for updating Semillero
    $(document).on('click', '#btnActualizarSemillero', function (e) {
        e.preventDefault();
        
        // Get values from the modal inputs
        let nombre = $('#inputNombreSemillero').val();
        let iniciales = $('#inputIniciales').val();
        let lider = $('#inputLider').val();
        let token = $('#_token').val();
        
        // Ajax request to update the Semillero
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
