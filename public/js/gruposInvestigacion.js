$(document).ready(function () {
    let button = '';
    $(document).on('click', '.iconoModificar', function () {//Metodo para abrir la modal de modificar
        button = $(this);//Establecemos un punto de referencia
        //Sacamos la informacion de la tabla
        let nombreGrupo = $(button).parents('tr').find('td:eq(0)').text().trim();
        let estadoGrupo = $(button).parents('tr').find('td:eq(1)').text().trim();
        let estado = (estadoGrupo == "Activo") ? 1 : (estadoGrupo == "Inactivo") ? 0 : -1;
        $.ajax({//Realizamos una solicitud ajax para obtener la modal del controlador
            type: "GET",
            url: "showModalActualizar",
            success: function (data) {
                //Ponemos la modal en el DOM
                $('#ModalSection').html(data);
                //Se carga la informacion en la modal
                $('#modalModificarGrupos').find('#inputNombreGrupo').val(nombreGrupo);
                $('#modalModificarGrupos').find('#inputEstadoGrupo').val(estado);
                //Se muestra la modal
                $('#modalModificarGrupos').modal('show');
            }
        });
    });

    //Metodo para abrir la modal de registrar
    $(document).on('click', '#BtnRegistrarGrupo', function () {
        button = $(this);
        $.ajax({//Realizamos una solicitud ajax para sacar la modal del controlador
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                //Cargamos la modal en el DOM
                $('#ModalSection').html(data);
                //Mostramos la modal
                $('#modalRegistrarGrupos').modal('show');
            }
        });
    });

    $(document).on('click', '#btnActualizar', function (e) { //Metodo para realizar la actualizacion del elemento
        e.preventDefault();
        //Obtenemos un valor de referencia para la actualizacion
        let nombre_old = $(button).parents('tr').find('td:eq(0)').text().trim();
        //Obtenemos los datos de los inputs
        let nombre = $('#inputNombreGrupo').val();
        let estado = $('#inputEstadoGrupo').val();
        let estado_text = (estado == 1) ? "Activo" : (estado == 0) ? "Inactivo" : null;
        //Obtenemos el token de autenticacion(Input Hidden)
        let token = $('#_token').val();

        $.ajax({//Realizamos una solicitud ajax que envia la informacion para realizar el registro
            type: "POST",
            url: "actualizar_grupos",
            data: {
                '_token': token,
                'nombre_grupo': nombre,
                'nombre_grupo_old': nombre_old,
                'estado_grupo': estado
            },
            success: function (data) {
                //Mostramos el alerta correcpondiente
                $('#alertasModificar').html(data.alerta);
                //Mostramos la tabla con los datos actualizados
                $('#tabla_grupos').html(data.tabla)
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

    $(document).on('click', '#btnRegistrar', function (e) { //Metodo para realizar el registro del elemento        
        e.preventDefault();
        //Obtenemos los valores de los input
        let nombre = $('#inputNombreGrupo').val();
        let token = $('#_token').val();

        $.ajax({//Realizamos una solicitud ajax para enviar la informacion para el registro
            type: "POST",
            url: "crear_grupos",
            data: {
                '_token': token,
                'nombre_grupo': nombre,
            },
            success: function (data) {
                //Mostrar los registros actualizados
                $('#tablebody_grupos').html(data.tabla);
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

