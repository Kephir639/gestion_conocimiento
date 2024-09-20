$(document).ready(function () {
    //Botón para abrir la modal y cargar los datos
    $(document).on('click', '.btnAsignar', function (e) {
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
    $(document).on('click', '.btnEnviarRol', function (e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del botón

        // Definir el botón como `this`, que es el elemento que ha disparado el evento
        let button = $(this);

        // Obtener el rol antiguo de la tabla
        let nombre_rol_old = button.parents('tr').find('td:eq(1)').text().trim();

        // Obtener el rol nuevo desde el select en el modal
        let nombre_rol = $('#inputRol').val();

        // Obtener el token CSRF
        let token = $('#_token').val();

        // Obtener el estado del usuario (esto depende de cómo estés manejando el estado)
        // Por ejemplo, si tienes un campo oculto o algo similar en el modal
        let estado = $('#inputEstado').val() || 1; // Por defecto 1 si no se encuentra el valor
        let estado_text = estado == 1 ? 'ACTIVO' : 'INACTIVO'; // Asigna texto en función del estado

        $.ajax({
            type: "POST",
            url: "asignarRol", // Asegúrate que la URL sea la correcta
            data: {
                '_token': token,
                'nombre_rol': nombre_rol,
                'estado_usu': estado,
                'nombre_rol_old': nombre_rol_old
            },
            success: function (data) {
                // Actualizar la tabla con los nuevos datos
                button.parents('tr').find('td:eq(1)').text(nombre_rol);
                button.parents('tr').find('td:eq(2)').text(estado_text);

                // Mostrar mensaje de éxito en el modal
                $('#alertasModificar').html('<div class="alert alert-success">Rol actualizado con éxito</div>');
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    // Mostrar errores de validación en los campos correspondientes
                    $.each(errors, function (clave, valor) {
                        $("#div_" + clave).find('.errorValidacion').html(valor);
                    });
                } else {
                    console.log(error, status);
                }
            }
        });
    });


});