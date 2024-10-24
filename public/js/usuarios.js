$(document).ready(function () {
    let button = '';
    $(document).on('click', '.iconoModificar', function (e) {
        button = $(this);
        $.ajax({
            type: "GET",
            url: "showModalActualizar",
            data: "data",
            success: function (data) {
                $('#ModalSection').html(data);//Se añade el html de la modal al DOM

                $('#modalActualizarUsuario').modal('show');//Se muestra la modal
            }
        });
    });

    $(document).on('click', '#btnActualizar', function (e) {
        e.preventDefault();
        let documento = $(button).parents('tr').find('td:eq(2)').text().trim();//Sacamos el la informacion de la tabla
        let rol = $('#inputRol').val();
        let password = $('#inputPassword').val();
        let estado = $('#inputEstado').val();

        let token = $('#_token').val();
        $.ajax({
            type: "POST",
            url: "actualizar_usuarios",
            data: {
                'id_rol': rol,
                'password': password,
                'estado_usu': estado,
                'documento': documento,
                '_token': token
            },
            success: function (data) {
                console.log(data);
                $('#alertasActualizar').html(data.alerta);//Se muestra el alerta correspondiente en la modal

                $('#tablebody_usuarios').html(data.tabla);//Se actualiza la tabla con la informacion nueva
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (clave, valor) {
                        $("#div_" + clave).find('.errorValidacion').html(valor);
                    });
                }
            }
        });
    });
});