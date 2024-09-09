$(document).ready(function () {
    let button = '';

    $(document).on('click', '.iconoModificar', function () {
        button = $(this);
        let nombreLinea = $(this).parents('tr').find('td:eq(0)').text().trim();
        let estadoLinea = $(this).parents('tr').find('td:eq(1)').text().trim();
        let estado = (estadoLinea == "Activo") ? 1 : (estadoLinea == "Inactivo") ? 0 : -1;
        $.ajax({
            type: 'GET',
            url: 'showModalActualizar',
            success: function (data) {
                $('#ModalSection').html(data);

                $(this).find('#inputNombreLinea').val(nombreLinea);
                $(this).find('#inputEstadoLinea').val(estado);

                $('#modalModificarLinea').modal('show');
            }
        });
    });

    //Metodo para abrir la modal de registrar
    $(document).on('click', '#BtnRegistrarLinea', function () {
        button = $(this);

        $.ajax({
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                $('#ModalSection').html(data);
                $('#modalRegistrarLinea').modal('show');
            }
        });
    });

    $(document).on('click', '#btnActualizar', function (e) {
        //Solicitud de Ajax para realizar la actualizacion del elemento
        e.preventDefault();
        let nombre_old = button.parents('tr').find('td:eq(0)').text().trim();

        let nombre = $('#inputNombreLinea').val();
        let estado = $('#inputEstadoLinea').val();
        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "actualizarLinea",
            data: {
                '_token': token,
                'nombre_linea': nombre,
                'nombre_linea_old': nombre_old,
                'estado_linea': estado
            },
            success: function (data) {
                $('#alertasModificar').html(data);
                button.parents('tr').find('td:eq(0)').val(nombre);
                button.parents('tr').find('td:eq(1)').val(estado);
            }
        });
    });

    $(document).on('click', '#btnRegistrar', function (e) {
        //Solicitud de Ajax para realizar el registro del elemento
        e.preventDefault();
        let nombre = $('#inputNombreLinea').val();
        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "registrarLinea",
            data: {
                '_token': token,
                'nombre_linea': nombre,
            },
            success: function (data) {
                //Mostrar los registros actualizados
                $('#tablebody_lineas').html(data.tabla);

                //Mostrar Alerta
                $('#alertasRegistrar').html(data.alerta);
            }
        });
    });
});
