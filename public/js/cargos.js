$(document).ready(function () {
    let button = '';
    $('.btnEditarCargo').on('click', function () {
        button = $(this);
        let nombreCargo = $(this).parents('tr').find('td:eq(0)').text().trim();
        let estadoCargo = $(this).parents('tr').find('td:eq(1)').text().trim();
        let estado = (estadoCargo == "Activo") ? 1 : (estadoCargo == "Inactivo") ? 0 : -1;
        $.ajax({
            type: 'GET',
            url: 'showModalActualizar',
            success: function (data) {
                $('#ModalSection').html(data);

                $(this).find('#inputNombreCargo').val(nombreCargo);
                $(this).find('#inputEstadoCargo').val(estado);

                $('#modalModificarCargo').modal('show');
            }
        });
    });

    //Metodo para abrir la modal de registrar
    $('#BtnRegistrarCargo').on('click', function () {
        button = $(this);
        $.ajax({
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                $('#ModalSection').html(data);
                $('#modalRegistrarCargo').modal('show');
            }
        });
    });

    $('#formModificar').submit(function (e) {
        //Solicitud de Ajax para realizar la actualizacion del elemento
        e.preventDefault();
        let nombre_old = button.parents('tr').find('td:eq(0)').text().trim();

        let nombre = $('#inputNombreCargo').val();
        let estado = $('#inputEstadoCargo').val();
        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "actualizarCargo",
            data: {
                '_token': token,
                'nombre_cargo': nombre,
                'nombre_cargo_old': nombre_old,
                'estado_cargo': estado
            },
            success: function (data) {
                $('#alertasModificar').html(data);
                button.parents('tr').find('td:eq(0)').val(nombre);
                button.parents('tr').find('td:eq(1)').val(estado);
            }
        });
    });

    $('#formRegistrar').submit(function (e) {
        //Solicitud de Ajax para realizar el registro del elemento
        e.preventDefault();
        let nombre = $('#inputNombreCargo').val();
        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "registrarCargo",
            data: {
                '_token': token,
                'nombre_cargo': nombre,
            },
            success: function (data) {
                //Mostrar los registros actualizados
                $('#tablebody_cargos').html(data.tabla);

                //Mostrar Alerta
                $('#alertasRegistrar').html(data.alerta);
            }
        });
    });
});
