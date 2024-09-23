$(document).ready(function () {
    let button = "";
    //Botón para abrir la modal y cargar los datos
    $(document).on('click', '.btnAsignar', function (e) {
        button = $(this);
        e.preventDefault();
        let nombre = $(this).parents('tr').find('td:eq(0)').text().trim();
        let apellido = $(this).parents('tr').find('td:eq(1)').text().trim();

        let nombreCompleto = nombre + " " + apellido;
        $.ajax({
            type: 'GET',
            url: 'showModalAsignarRol',

            success: function (data) {
                $('#ModalSection').html(data);  // Cargar el contenido del modal
                $('#modalAsignarRol').modal('show');  // Mostrar el modal

                $('#inputNombreUsuario').val(nombreCompleto);
            }
        });
    });
    $(document).on('click', '#btnAsignarRol', function (e) {
        e.preventDefault();
        let idRol = $('#inputRol').val();
        let documento = $(button).parents('tr').find('td:eq(2)').text().trim()

        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "asignarRol",
            data: {
                'idRol': idRol,
                'documento': documento,
                '_token': token
            },
            success: function (data) {
                // Mostrar mensaje de éxito en el modal
                $('#alertasModificar').html(data);

            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    // Mostrar errores de validación en los campos correspondientes
                    $.each(errors, function (clave, valor) {
                        $("#div_" + clave).find('.errorValidacion').html(valor);
                    });
                } else {
                    // console.log(error, status);
                }
            }
        });
    });


});