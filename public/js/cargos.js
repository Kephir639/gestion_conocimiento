$(document).ready(function () {
    let button = '';

    $(document).on('click', '.iconoModificar', function () {
        button = $(this);
        let nombreCargo = $(this).parents('tr').find('td:eq(0)').text().trim();
        let estadoCargo = $(this).parents('tr').find('td:eq(1)').text().trim();
        let estado = (estadoCargo == "Activo") ? 1 : (estadoCargo == "Inactivo") ? 0 : -1;
        $.ajax({
            type: 'GET',
            url: 'showModalActualizar',
            success: function (data) {
                $('#ModalSection').html(data);

                $('#modalModificarCargo').find('#inputNombreCargo').val(nombreCargo);
                $('#modalModificarCargo').find('#inputEstadoCargo').val(estado);

                $('#modalModificarCargo').modal('show');
            }
        });
    });

    //Metodo para abrir la modal de registrar
    $(document).on('click', '#BtnRegistrarCargo', function () {
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

    $(document).on('click', '#btnActualizar', function (e) {
        //Solicitud de Ajax para realizar la actualizacion del elemento
        e.preventDefault();
        let nombre_old = button.parents('tr').find('td:eq(0)').text().trim();

        let nombre_cargo = $('#inputNombreCargo').val();
        let estado = $('#inputEstadoCargo').val();
        let token = $('#_token').val();
        let estado_cargo = (estado == 1) ? "Activo" : (estado == 0) ? "Inactivo" : "Seleccione una opcion...";


        $.ajax({
            type: "POST",
            url: "actualizarCargo",
            data: {
                '_token': token,
                'nombre_cargo': nombre_cargo,
                'nombre_cargo_old': nombre_old,
                'estado_cargo': estado
            },
            success: function (data) {
                $('#alertasModificar').html(data);
                $(button).parents('tr').find('td:eq(0)').text(nombre_cargo);
                $(button).parents('tr').find('td:eq(1)').text(estado_cargo);
            }
        });
    });

    $(document).on('click', '#btnRegistrar', function (e) {
        //Solicitud de Ajax para realizar el registro del elemento
        e.preventDefault();
        let nombre = $('#inputNombreCargo').val();
        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "registrarCargos",
            data: {
                '_token': token,
                'nombre_cargo': nombre,
            },
            success: function (data) {
                //Mostrar los registros actualizados
                console.log(data.tabla);
                $('#tablebody_cargos').html(data.tabla);

                //Mostrar Alerta
                $('#alertasRegistrar').html(data.alerta);
            }
        });
    });
});
