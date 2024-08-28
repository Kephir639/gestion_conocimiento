$(document).ready(function () {
    //Metodo para abrir la modal de modificar
    $('#BtnModificarRed').on('click', function () {
        $.ajax({
            type: "GET",
            url: "showModalActualizar",
            success: function (data) {
                $('#ModalSection').html(data);
                $('#modalModificarRedes').modal('show');
                console.log('SI abre');
            }
        });
    });

    //Metodo para abrir la modal de registrar
    $('#BtnRegistrarRed').on('click', function () {
        $.ajax({
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                $('#ModalSection').html(data);
                $('#modalRegistrarRedes').modal('show');
            }
        });
    });
    
    let modal = $('#modalModificarRedes');
    $(modal).on('show.bs.modal', function (e) {
        //Metodo para traer la informacion de la tabla hacia la modal de modificar
        console.log('SI se pudo')
        let button = $(e.relatedTarget);
        let nombreRed = button.parents('tr').find('td:eq(0)').text().trim();
        let estadoRedText = button.parents('tr').find('td:eq(1)').text().trim();
        let valueEstado = -1;

        if (estadoRedText == "Activo") {
            valueEstado = 1
        } else {
            valueEstado = 0
        }
        $(this).find('#inputNombreRed').val(nombreRed);
        $(this).find('#inputEstadoRed').val(valueEstado);
    });

    $('#formModificar').submit(function (e) {
        //Solicitud de Ajax para realizar la actualizacion del elemento
        e.preventDefault();
        let boton = $('#BtnModificarRed');
        let nombre_old = boton.parents('tr').find('td:eq(0)').text().trim();

        let nombre = $('#inputNombreRed').val();
        let estado = $('#inputEstadoRed').val();
        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "actualizarRedes",
            data: {
                '_token': token,
                'nombre_red': nombre,
                'nombre_red_old': nombre_old,
                'estado_red': estado
            },
            success: function (data) {
                $('#alertasModificar').html(data);
            }
        });
    });

    $('#formRegistrar').submit(function (e) {
        //Solicitud de Ajax para realizar la actualizacion del elemento
        e.preventDefault();
        let boton = $('#BtnRegistrarRed');

        let nombre = $('#inputNombreRed').val();
        let token = $('#_token').val();

        let modal = $('#modalModificar');

        $.ajax({
            type: "POST",
            url: "actualizarRedes",
            data: {
                '_token': token,
                'nombre_red': nombre,
            },
            success: function (data) {
                $('#alertasRegistrar').html(data);
            }
        });
    });

    

    // $('#modalModifcarRedes').on('hidden.bs.modal', function () {
    //     $('#ModalSection').empty();
    // });

    // $('#modalRegistrarRedes').on('hidden.bs.modal', function () {
    //     $('#ModalSection').empty();
    // });

});

