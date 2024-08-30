$(document).ready(function () {
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

                $(this).find('#inputNombreGrupo').val(nombreGrupo);
                $(this).find('#inputEstadoGrupo').val(estado);

                $('#modalModificarGrupo').modal('show');                
            }
        });
    });

    //Metodo para abrir la modal de registrar
    $('#BtnRegistrarGrupo').on('click', function () {
        button = $(this);
        $.ajax({
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                $('#ModalSection').html(data);
                $('#modalRegistrarGrupo').modal('show');
            }
        });
    });
    
    $('#formModificar').submit(function (e) {
        //Solicitud de Ajax para realizar la actualizacion del elemento
        e.preventDefault();        
        let nombre_old = button.parents('tr').find('td:eq(0)').text().trim();

        let nombre = $('#inputNombreGrupo').val();
        let estado = $('#inputEstadoGrupo').val();        
        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "actualizarGrupo",
            data: {
                '_token': token,
                'nombre_grupo': nombre,
                'nombre_grupo_old': nombre_old,
                'estado_grupo': estado
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
                }else{
                    console.log(error, status);
                }
            }
        });
    });

    $('#formRegistrar').submit(function (e) {
        //Solicitud de Ajax para realizar el registro del elemento
        e.preventDefault();        
        let nombre = $('#inputNombreGrupo').val();
        let token = $('#_token').val();        

        $.ajax({
            type: "POST",
            url: "crear_grupo",
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
            error: function(xhr, status, error){
                if (xhr.status===422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (clave, valor) { 
                         $("#Div_" + clave).find('.errorValidacion').html(valor);
                    });
                }
            }
        });
    });
    
});

