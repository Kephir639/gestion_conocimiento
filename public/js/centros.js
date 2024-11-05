$(document).ready(function () {
    let button = '';

    $(document).on('click', '.iconoModificar', function () { //Metodo para abrir la modal de modificar
        button = $(this); //Establecemos el punto de referencia
        //Sacamos la informacion de la tabla
        let codigoCentro = $(this).parents('tr').find('td:eq(0)').text().trim();
        let nombreCentro = $(this).parents('tr').find('td:eq(1)').text().trim();
        let estado = $(this).parents('tr').find('td:eq(2)').text().trim();
        let estadoCentro = (estado == "Activo") ? 1 : (estado == "Inactivo") ? 0 : -1;
        $.ajax({//Solicitud de ajax para sacar la modal del controlador
            type: "GET",
            url: "showModalActualizar",
            success: function (data) {
                //Pondemos la modal en el DOM
                $('#ModalSection').html(data);
                //Cargamos la informacion del centro en la modal
                $('#modalModificarCentros').find('#inputCodigoCentro').val(codigoCentro);
                $('#modalModificarCentros').find('#inputNombreCentro').val(nombreCentro);
                $('#modalModificarCentros').find('#inputEstadoCentro').val(estadoCentro);
                //Mostramos la modal
                $('#modalModificarCentros').modal('show');
            }
        });
    });

    $(document).on('click', '#BtnRegistrarCentro', function () {//Metodo para abrir la modal de registrar
        button = $(this);
        $.ajax({//Relizamos una solicitud ajax para sacar la modal del controlador
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                //Agregamos la modal en el DOM
                $('#ModalSection').html(data);
                //Mostramos la modal
                $('#modalRegistrarCentro').modal('show');
            }
        });
    });

    $(document).on('click', '#btnActualizar', function (e) {//Funcion para realizar la actualizacion del elemento
        e.preventDefault();
        //Obtenemos un dato de referencia para la actualizacion
        let nombre_old = $(button).parents('tr').find('td:eq(1)').text().trim();
        //Obtenemos la informacion de los inputs
        let codigo = $('#inputCodigoCentro').val();
        let nombre = $('#inputNombreCentro').val();
        let estado = $('#inputEstadoCentro').val();
        //Obtenemos el token de autenticacion(Input Hidden)
        let token = $('#_token').val();

        $.ajax({//Realizamos una peticion ajax para enviar la informacion del centro para su actualizacion
            type: "POST",
            url: "actualizar_centros",
            data: {
                '_token': token,
                'codigo_centro': codigo,
                'nombre_centro': nombre,
                'estado_centro': estado,
                'nombre_centro_old': nombre_old
            },
            success: function (data) {
                //Mostrar los registros actualizados
                $('#tablebody_centros').html(data.tabla);
                //Mostrar Alerta
                $('#alertasModificar').html(data.alerta);
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

    $(document).on('click', '#btnRegistrar', function (e) { //Funcion para realizar el registro del elemento
        e.preventDefault();
        //Obtenemos los datos de los inputs
        let codigo = $('#inputCodigoCentro').val();
        let nombre = $('#inputNombreCentro').val();
        //Obtenemos el token de autenticacion(Input Hidden)
        let token = $('#_token').val();

        $.ajax({//Realizamos una solicitud ajax para realizar el registro del centro
            type: "POST",
            url: "crear_centros",
            data: {
                '_token': token,
                'codigo_centro': codigo,
                'nombre_centro': nombre
            },
            success: function (data) {
                //Mostrar los registros actualizados
                $('#tablebody_centros').html(data.tabla);
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

