$(document).ready(function () {
    let button = '';
    // Evento para abrir el modal de modificación
    $(document).on('click', '.iconoModificar', function () {
        button = $(this);
        let nombreSemillero = $(this).parents('tr').find('td:eq(1)').text().trim();
        let inicialesSemillero = $(this).parents('tr').find('td:eq(0)').text().trim();
        let liderSemillero = $(this).parents('tr').find('td:eq(2)').text().trim();

        $.ajax({
            type: "GET",
            url: "showModalActualizar",  // Cambia la URL según tu configuración
            success: function (data) {
                $('#ModalSection').html(data);
                $('#ModalModificarSemilleros').find('#inputNombreSemillero').val(nombreSemillero);
                $('#ModalModificarSemilleros').find('#inputInicialesSemillero').val(inicialesSemillero);
                $('#ModalModificarSemilleros').find('#inputLiderSemillero').val(liderSemillero);

                $('#ModalModificarSemilleros').modal('show');
            }
        });
    });

    // Evento para modificar el semillero
    $(document).on('click', '#btnModificarSemillero', function (e) {
        e.preventDefault();
        let nombre_old = $(button).parents('tr').find('td:eq(1)').text().trim();  // Cambia la columna a 1 para obtener el nombre viejo

        let nombre = $('#inputNombreSemillero').val();
        let iniciales = $('#inputInicialesSemillero').val();
        let lider = $('#inputLiderSemillero').val();
        let token = $('#_tokenSemillero').val();  // Asegúrate de que tienes el token en el modal

        $.ajax({
            type: "POST",
            url: "actualizar_semilleros ",  // Cambia la URL según tu configuración
            data: {
                '_token': token,
                'nombre_semillero': nombre,
                'nombre_semillero_old': nombre_old,
                'iniciales_semillero': iniciales,
                'lider_semillero': lider
            },
            success: function (data) {
                $('#alertasModificarSemillero').html(data);
                $(button).parents('tr').find('td:eq(1)').text(nombre);  // Actualiza el nombre en la tabla
                $(button).parents('tr').find('td:eq(0)').text(iniciales);  // Actualiza las iniciales en la tabla
                $(button).parents('tr').find('td:eq(2)').text(lider);  // Actualiza el líder en la tabla

                $('#ModalModificarSemilleros').modal('hide');  // Cierra el modal
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (clave, valor) {
                        $("#div_" + clave).find('.errorValidacion').html(valor);  // Muestra errores de validación
                    });
                }
            }
        });
    });

    //Registrar nuevo Semillero
    $(document).on('click', '#BtnRegistrarSemillero', function (e) {
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

    //Método para registrar un nuevo semillero
    $(document).on('submit', '#formRegistrarSemillero', function (e) {
        e.preventDefault();

        // Collect values from the form fields
        let nombre_semillero = $('#inputNombreSemillero').val();
        let iniciales_semillero = $('#inputInicialesSemillero').val();
        let lider_semillero = $('#inputLiderSemillero').val();
        let fecha_creacion = $('#inputFechaCreacion').val();
        let mision = $('#inputMisionSemillero').val();
        let vision = $('#inputVisionSemillero').val();
        let objetivo_general = $('#inputObjetivoGeneral').val();
        let id_grupo = $('#inputIdGrupo').val();
        let objetivos_especificos = $('input[name="objetivos_especificos[]"]').map(function () {
            return $(this).val();
        }).get();
        let token = $('#_token').val();

        // Perform the AJAX request
        $.ajax({
            type: "POST",
            url: "crear_semillero",
            data: {
                '_token': token,
                'nombre_semillero': nombre_semillero,
                'iniciales_semillero': iniciales_semillero,
                'lider_semillero': lider_semillero,
                'fecha_creacion': fecha_creacion,
                'mision': mision,
                'vision': vision,
                'objetivo_general': objetivo_general,
                'objetivos_especificos': objetivos_especificos,
                'id_grupo': id_grupo
            },
            success: function (data) {
                // Update the table of semilleros
                $('#tablebody_semilleros').html(data.tabla);

                // Show alert messages
                $('#alertasRegistrarSemillero').html(data.alerta);

                // Reset the form fields after submission
                $('#formRegistrarSemillero')[0].reset();
                $('#modalRegistrarSemillero').modal('hide');
            },
            error: function (xhr) {
                // Handle errors here
                $('#alertasRegistrarSemillero').html('<div class="alert alert-danger">Error en el registro. Por favor, inténtelo de nuevo.</div>');
            }
        });
    });

    //Nuevo Integrante

    $(document).on('click', '#BtnValidar', function (e) {
        button = $(this);
        $.ajax({
            type: "GET",
            url: "showModalValidar",
            success: function (data) {
                $('#ModalSection').html(data);
                $('#modalVincularPendientes').modal('show');
            }
        });
    });




    // Evento para abrir el modal de ver semillero
    $(document).on('click', '.iconoConsultar', function () {
        let inicialesSemillero = $(this).parents('tr').find('td:eq(0)').text().trim();

        // Hacer una llamada AJAX para obtener los detalles del semillero
        $.ajax({
            type: "GET",
            url: "showModalVer",  // Asegúrate de que esta URL coincida con tu ruta definida en las rutas de Laravel
            data: { iniciales: inicialesSemillero },  // Enviar las iniciales del semillero
            success: function (data) {
                $('#ModalSection').html(data);  // Cargar el contenido de la vista en la sección del modal

                $('#modalVerSemillero').modal('show');  // Mostrar el modal una vez que los datos se carguen
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (clave, valor) {
                        $("#div_" + clave).find('.errorValidacion').html(valor);  // Muestra errores de validación
                    });
                }
            }
        });
    });
});
