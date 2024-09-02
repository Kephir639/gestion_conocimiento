$(document).ready(function () {
    //Metodo para abrir la modal de modificar
    let button = '';
    //Metodo para abrir la modal de modificar
    $('.iconoModificar').on('click', function () {
        button = $(this);
        let nombreGrupo = $(this).parents('tr').find('td:eq(0)').text().trim();
        let estadoGrupo = $(this).parents('tr').find('td:eq(1)').text().trim();
        let estado = (estadoGrupo == "Activo") ? 1 : (estadoGrupo == "Inactivo") ? 0 : -1;
        $.ajax({
            type: "GET",
            url: "showModalActualizar",
            success: function (data) {
                $('#ModalSection').html(data);

                $(this).find('#inputNombreRed').val(nombreGrupo);
                $(this).find('#inputEstadoRed').val(estado);

                $('#modalModificarRed').modal('show');                
            }
        });
    });

    //Metodo para abrir la modal de registrar
    $('#BtnRegistrarRed').on('click', function () {
        button = $(this);
        $.ajax({
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                $('#ModalSection').html(data);
                $('#modalRegistrarRed').modal('show');
            }
        });
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
                button.parents('tr').find('td:eq(0)').val(nombre);
                button.parents('tr').find('td:eq(1)').val(estado);
            },
            error: function(xhr, status, error){
                if (xhr.status===422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (clave, valor) { 
                         $("#div_" + clave).find('.errorValidacion').html(valor);
                    });
                }
            }
        });
    });

    $('#formRegistrar').submit(function (e) {
        //Solicitud de Ajax para realizar la actualizacion del elemento
        e.preventDefault();        
        
        let nombre = $('#inputNombreRed').val();
        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "crear_redes",
            data: {
                '_token': token,
                'nombre_red': nombre,
            },
            success: function (data) {                            
                //Mostrar los registros actualizados
                $('#tablebody_grupos').html(data.tabla);

                //Mostrar Alerta
                $('#alertasRegistrar').html(data.alerta);
            },
            error: function(xhr, status, error){
                if (xhr.status===422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (clave, valor) { 
                         $("#div_" + clave).find('.errorValidacion').html(valor);
                    });
                }else{
                    console.log(error, status);
                }
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

