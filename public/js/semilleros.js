$(document).ready(function () {
    let button = '';

    //Modificar
    $(document).on('click', '#BtnModificarSemillero', function (e) {
        button = $(this);
        $.ajax({
            type: "GET",
            url: "showModalActualizar",
            success: function (data) {
                $('#ModalSection').html(data);
                $('#ModalModificarSemilleros').modal('show');
            }
        });
    });



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

    //Ver detalles semillero

    $(document).on('click', '#BtnVerSemilleros', function (e) {
        button = $(this);
        $.ajax({
            type: "GET",
            url: "showModalVer",
            success: function (data) {
                $('#ModalSection').html(data);
                $('#modalVerSemillero').modal('show');
            }
        });
    });

    $(document).on('click', '[data-bs-target="#modalVerSemillero"]', function () {
        $.ajax({
            url: 'verSemilleros',  // Asegúrate de que este sea el endpoint correcto
            type: 'GET',
            success: function (data) {
                //Limpiar la tabla antes de insertar nuevos datos
                $('#tablaSemilleros').empty();

                // Insertar los datos en la tabla
                data.semilleros.forEach(function (semillero) {
                    $('#tablaSemilleros').append(`
                         <tr>
                             <td>${semillero.id_semillero}</td>
                             <td>${semillero.nombre_semillero}</td>
                             <td>${semillero.iniciales_semillero}</td>
                             <td>${semillero.fecha_creacion}</td>
                             <td>${semillero.mision}</td>
                             <td>${semillero.vision}</td>
                             <td>${semillero.objetivo_general}</td>
                             <td>${semillero.objetivos_especificos}</td>
                             <td>${semillero.id_grupo}</td>
                         </tr>
                     `);
                });
            },
            error: function (error) {
                console.log("Error:", error);
            }
        });
    });



    //Actualizar Semillero
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

    // Método para registrar un nuevo semillero
    // $(document).on ('click','#BtnRegistrarSemillero',function (e) {
    //     e.preventDefault();
    //     // $('#modalRegistrarSemillero').modal('show');
    //     let nombre = $('#inputNombreSemillero').val();
    //     let descripcion = $('#inputDescripcionSemillero').val();
    //     let coordinador = $('#inputCoordinadorSemillero').val();
    //     let token = $('#_token').val();

    //     $.ajax({
    //         type: "POST",
    //         url: "registrarSemillero",
    //         data: {
    //             '_token': token,
    //             'nombre_semillero': nombre,
    //             'descripcion_semillero': descripcion,
    //             'coordinador_semillero': coordinador
    //         },
    //         success: function (data) {
    //             // Actualizar la tabla de semilleros
    //             $('#tablebody_semilleros').html(data.tabla);

    //             // Mostrar alerta
    //             $('#alertasRegistrarSemillero').html(data.alerta);
    //         }
    //     });
    // });


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


});
