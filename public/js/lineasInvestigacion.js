$(document).ready(function () {
    let button = '';

    $(document).on('click', '.iconoModificar', function () {//Metodo para mostrar la modal de actualizar
        button = $(this);//Establecemos el punto de referencia        
        //Obtenemos los datos de la tabla con el punto de referencia
        let nombreLinea = $(button).parents('tr').find('td:eq(0)').text().trim();
        let estadoLinea = $(button).parents('tr').find('td:eq(1)').text().trim();
        let estado = (estadoLinea == "Activo") ? 1 : (estadoLinea == "Inactivo") ? 0 : -1;
        $.ajax({//Realizamos una solicitud ajax para obtener la modal
            type: 'GET',
            url: 'showModalActualizar',
            success: function (data) {
                //Agregamon la modal al DOM
                $('#ModalSection').html(data);
                //Añadimos  la informacion a la modal
                $('#ModalModificarLineas').find('#inputNombreLinea').val(nombreLinea);
                $('#ModalModificarLineas').find('#inputEstadoLinea').val(estado);
                //Mostramos la modal
                $('#ModalModificarLineas').modal('show');
            }
        });
    });

    $(document).on('click', '#BtnRegistrarLinea', function () {//Metodo para abrir la modal de registrar
        button = $(this);

        $.ajax({//Realizamos una solicitud ajax para obtener la modal
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                //Agregamos la modal al DOM
                $('#ModalSection').html(data);
                //Mostramos la modal
                $('#modalRegistrarLinea').modal('show');
            }
        });
    });

    $(document).on('click', '#btnActualizar', function (e) {
        e.preventDefault();
        //Obtenemos un valor de referencia para la actualizacion
        let nombre_old = $(button).parents('tr').find('td:eq(0)').text().trim();
        //Obtenemos los valores de los inputs
        let id_linea = $(button).attr('id');
        let nombre = $('#inputNombreLinea').val();
        let estado = $('#inputEstadoLinea').val();        
        //Obtenemos el token de autenticacion(Input Hidden)
        let token = $('#_token').val();

        $.ajax({//Solicitud de Ajax para realizar la actualizacion del elemento
            type: "POST",
            url: "actualizar_lineas",
            data: {
                '_token': token,
                'id_linea': id_linea,
                'nombre_linea': nombre,
                'nombre_linea_old': nombre_old,
                'estado_linea': estado
            },
            success: function (data) {
                //Mostramos el alerta correspondiente
                $('#alertasModificar').html(data.alerta);
                //Mostramos la tabla con los datos
                $('#tablebody_lineas').html(data.tabla)
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

    $(document).on('click', '#btnRegistrar', function (e) {
        e.preventDefault();
        let nombre = $('#inputNombreLinea').val();
        let token = $('#_token').val();

        $.ajax({//Solicitud de Ajax para realizar el registro del elemento
            type: "POST",
            url: "crear_lineas",
            data: {
                '_token': token,
                'nombre_linea': nombre,
            },
            success: function (data) {
                //Mostrar los registros actualizados
                $('#tablebody_lineas').html(data.tabla);
                //Mostrar Alerta
                $('#alertasRegistrar').html(data.alerta);
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
});
