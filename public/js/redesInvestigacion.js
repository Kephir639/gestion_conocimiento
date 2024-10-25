$(document).ready(function () {
    let button = '';
    $(document).on('click', '.iconoModalModificar', function () {//Metodo para abrir la modal de modificar
        button = $(this);//Establecemos el punto de referencia
        //Obtenemos los datos de la tabla utilizando los puntos de referencia
        let nombreGrupo = $(this).parents('tr').find('td:eq(0)').text().trim();
        let estadoGrupo = $(this).parents('tr').find('td:eq(1)').text().trim();
        let estado = (estadoGrupo == "Activo") ? 1 : (estadoGrupo == "Inactivo") ? 0 : -1;
        $.ajax({//Realizamos una peticion ajax para obtener la modal
            type: "GET",
            url: "showModalActualizar",
            success: function (data) {
                //Agregamos la modal al DOM
                $('#ModalSection').html(data);
                //Insertamos los datos en la modal
                $('#modalModificarRedes').find('#inputNombreRed').val(nombreGrupo);
                $('#modalModificarRedes').find('#inputEstadoRed').val(estado);
                //Mostramos la modal
                $('#modalModificarRedes').modal('show');
            }
        });
    });

    $('#BtnModalRegistrarRed').on('click', function () {//Metodo para abrir la modal de registrar
        button = $(this);
        $.ajax({//Realizamos una peticion ajax para obtener la modal
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                //Agregamos la modal al DOM
                $('#ModalSection').html(data);
                //Mostramos la modal
                $('#modalRegistrarRedes').modal('show');
            }
        });
    });

    $(document).on('click', '#btnModificar', function (e) {//Metodo para enviar la informacion de actualizacion
        e.preventDefault();
        //Obtenemos el campo de referencia para la acutalizacion
        let nombre_old = $(button).parents('tr').find('td:eq(0)').text().trim();
        //Obtenemos los valores de los inputs
        let nombre = $('#inputNombreRed').val();
        let estado = $('#inputEstadoRed').val();
        let estado_text = (estado == 1) ? "Activo" : (estado == 0) ? "Inactivo" : null;
        //Obtenemos el token de autenticacion
        let token = $('#_token').val();
        $.ajax({//Realizamos una peticion ajax para enviar la informacion al controlador
            type: "POST",
            url: "actualizar_redes",
            data: {
                '_token': token,
                'nombre_red': nombre,
                'nombre_red_old': nombre_old,
                'estado_red': estado
            },
            success: function (data) {
                //Mostramos el alerta correspondiente
                $('#alertasModificar').html(data.alerta);
                //Mostramos la tabla con los datos actualizados
                $('#tablebody_redes').html(data.tabla);
            },
            error: function (xhr, status, error) { //En caso de recibir un error
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors; //Obtenemos los errores de la validacion

                    $.each(errors, function (clave, valor) {
                        //Mostramos los errores correspondientes en cada input
                        $("#div_" + clave).find('.errorValidacion').html(valor);
                    });
                }
            }
        });
    });

    $(document).on('click', '#btnRegistrar', function (e) {//Metodo para enviar la informacion para el registro
        e.preventDefault();
        //Obtenemos los datos de los inputs
        let nombre = $('#inputNombreRed').val();
        //Obtenemos el token de autenticacion
        let token = $('#_token').val();
        $.ajax({//Realizamos una peticion ajax para enviar la informacion al controlador
            type: "POST",
            url: "crear_redes",
            data: {
                '_token': token,
                'nombre_red': nombre,
            },
            success: function (data) {
                //Mostrar los registros actualizados
                $('#tablebody_redes').html(data.tabla);
                //Mostrar Alerta
                $('#alertasRegistrar').html(data.alerta);
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

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

