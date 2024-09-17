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
            type: 'POST',
            url: 'actualizarSemillero', // Change this URL to match your backend route
            data: {
                '_token': token,
                'nombre_semillero': nombre,
                'iniciales': iniciales,
                'lider_semillero': lider,
            },
            success: function (response) {
                // Update the table with new values
                $(button).parents('tr').find('td:eq(0)').text(nombre);
                $(button).parents('tr').find('td:eq(1)').text(iniciales);
                $(button).parents('tr').find('td:eq(2)').text(lider);

                // Show success message (can be updated based on the response)
                $('#alertasModificar').html('<div class="alert alert-success">Semillero actualizado correctamente</div>');
                
                // Hide the modal after updating
                $('#ModalModificarSemilleros').modal('hide');
            },
            error: function (xhr, status, error) {
                // Handle error response
                $('#alertasModificar').html('<div class="alert alert-danger">Hubo un error al actualizar el semillero</div>');
            }
        });
    });
});
