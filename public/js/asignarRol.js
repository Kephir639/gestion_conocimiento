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
        let usuarioSeleccionado = [];

        // Iterar sobre cada checkbox seleccionado y obtener los nombres de las filas
        $('.userCheckbox:checked').each(function () {
            let row = $(this).closest('tr');  // Obtener la fila donde está el checkbox
            let nombre = row.find('td:eq(1)').text().trim();
            let apellido = row.find('td:eq(2)').text().trim();
            let nombreCompleto = nombre + " " + apellido;
            usuarioSeleccionado.push(nombreCompleto);
        });

        // Verificar si hay usuarios seleccionados
        if (usuarioSeleccionado.length === 0) {
            alert("Selecciona al menos un usuario.");
            return;
        }

        // Solicitud AJAX para cargar la modal con los datos de los usuarios seleccionados
        $.ajax({
            type: 'GET',
            url: 'showModalAsignarRol',
            success: function (data) {

                $('#ModalSection').html(data);

                $('#modalAsignarRol').modal('show');

                let nombresUsuarios = usuarioSeleccionado.join(', ');
                $('#inputNombreUsuario').val(nombresUsuarios);
            }
        });
    });

    // Seleccionar todos los usuarios
    $('#selectAll').on('click', function () {
        $('.userCheckbox').prop('checked', this.checked);
    });

});
$(document).on('click', '#btnAsignarRol', function (e) {
    button = $(this);
    e.preventDefault();
    let idRol = $('#inputRol').val();
    let token = $('#_token').val();
    let documentosSeleccionados = [];


    $.ajax({
        type: "POST",
        url: "asignarRol",
        data: {
            'idRol': idRol,
            'documento': documentosSeleccionados,
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
