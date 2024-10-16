$(document).ready(function () {
    let button = "";
    //Botón para abrir la modal y cargar los datos de un solo usuario
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

    //Selección de más datos
    $(document).on('click', '.btnAsignarTodo', function (e) {
        button = $(this);
        e.preventDefault();


        // Solicitud AJAX para cargar la modal con los datos de los usuarios seleccionados
        $.ajax({
            type: 'GET',
            url: 'showModalAsignarRol',
            success: function (data) {

                $('#ModalSection').html(data);

                $('#modalAsignarRol').modal('show');

            }
        });
    });

    // Seleccionar todos los usuarios
    $('#selectAll').on('click', function () {
        $('.userCheckbox').prop('checked', this.checked);
    });

});
$(document).on('click', '#btnActualizar', function (e) {
    button = $(this);
    e.preventDefault();
    let idRol = $('#inputRol').val();
    let token = $('#_token').val();
    let documentosSeleccionados = $('input[name="userCheckbox[]"]:checked').map(function () { return $(this).val(); }).get(); //se busca la data y luego se asigna en la variable
    let estado = $('#inputEstado').val();
    $.ajax({
        type: "POST",
        url: "asignarRol",
        data: {
            'idRol': idRol,
            'documentos': documentosSeleccionados,
            'estado_usu': estado,
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
