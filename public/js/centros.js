$(document).ready(function () {
    let button = '';
    //Metodo para abrir la modal de modificar
    $(document).on('click', '.iconoModificar', function () {
        button = $(this);
        let codigoCentro = $(this).parents('tr').find('td:eq(0)').text().trim();
        let nombreCentro = $(this).parents('tr').find('td:eq(1)').text().trim();
        let estado = $(this).parents('tr').find('td:eq(2)').text().trim();
        let estadoCentro = (estado == "Activo") ? 1 : (estado == "Inactivo") ? 0 : -1;
        $.ajax({
            type: "GET",
            url: "showModalActualizar",
            success: function (data) {
                $('#ModalSection').html(data);

                $('#modalModificarCentros').find('#inputCodigoCentro').val(codigoCentro);
                $('#modalModificarCentros').find('#inputNombreCentro').val(nombreCentro);
                $('#modalModificarCentros').find('#inputEstadoCentro').val(estadoCentro);

                $('#modalModificarCentros').modal('show');
            }
        });
    });

    //Metodo para abrir la modal de registrar
    $(document).on('click', '#BtnRegistrarCentro', function () {
        button = $(this);
        $.ajax({
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                $('#ModalSection').html(data);
                $('#modalRegistrarCentro').modal('show');
            }
        });
    });

    $(document).on('click', '#btnActualizar', function (e) {
        //Solicitud de Ajax para realizar la actualizacion del elemento
        e.preventDefault();
        let nombre_old = $(button).parents('tr').find('td:eq(1)').text().trim();

        let codigo = $('#inputCodigoCentro').val();
        let nombre = $('#inputNombreCentro').val();
        let estado = $('#inputEstadoCentro').val();
        let token = $('#_token').val();

        let estado_text = (estado == 1) ? "Activo" : (estado == 0) ? "Inactivo" : null;

        $.ajax({
            type: "POST",
            url: "actualizarCentro",
            data: {
                '_token': token,
                'codigo_centro': codigo,
                'nombre_centro': nombre,
                'estado_centro': estado,
                'nombre_centro_old': nombre_old
            },
            success: function (data) {
                $('#alertasModificar').html(data);
                $(button).parents('tr').find('td:eq(0)').text(codigo);
                $(button).parents('tr').find('td:eq(1)').text(nombre);
                $(button).parents('tr').find('td:eq(2)').text(estado_text);
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

    $(document).on('click', '#btnRegistrar', function (e) {
        //Solicitud de Ajax para realizar el registro del elemento
        e.preventDefault();

        let codigo = $('#inputCodigoCentro').val();
        let nombre = $('#inputNombreCentro').val();
        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "registrarCentros",
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

