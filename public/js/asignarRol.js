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

    //Selección de más datos
    $(document).on('click', '.btnAsignarTodo', function (e) {
        e.preventDefault();

        let idRol = $('#inputRol').val();  // Captura el rol seleccionado
        let token = $('#_token').val();    // Captura el token CSRF
        let selectedUsers = [];            // Array para almacenar los usuarios seleccionados

        // Iterar sobre cada checkbox seleccionado y obtener los nombres de las filas
        $('.userCheckbox:checked').each(function () {
            let row = $(this).closest('tr');  // Obtener la fila donde está el checkbox
            let nombre = row.find('td:eq(1)').text().trim();  // Captura el nombre (2da columna)
            let apellido = row.find('td:eq(2)').text().trim();  // Captura el apellido (3ra columna)

            // Formar el nombre completo y añadirlo a la lista de usuarios seleccionados
            let nombreCompleto = nombre + " " + apellido;
            selectedUsers.push(nombreCompleto);
        });

        // Verificar si hay usuarios seleccionados
        if (selectedUsers.length === 0) {
            alert("Selecciona al menos un usuario.");
            return;
        }

        // Solicitud AJAX para cargar la modal con los datos de los usuarios seleccionados
        $.ajax({
            type: 'GET',
            url: 'showModalAsignarRol',  // Ruta para mostrar el modal
            data: {
                'idRol': idRol,
                'documentos': selectedUsers,  // Lista de usuarios seleccionados
                '_token': token
            },
            success: function (data) {
                // Cargar el contenido del modal en el div correspondiente
                $('#ModalSection').html(data);

                // Mostrar el modal
                $('#modalAsignarRol').modal('show');

                // Llenar los campos del modal con los nombres de los usuarios seleccionados
                let nombresUsuarios = selectedUsers.join(', ');  // Unir los nombres en una sola cadena
                $('#inputNombreUsuario').val(nombresUsuarios);  // Asignar la cadena al campo de nombres
            }
        });
    });

    // Seleccionar todos los usuarios
    $('#selectAll').on('click', function () {
        $('.userCheckbox').prop('checked', this.checked);
    });
});