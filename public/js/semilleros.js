$(document).ready(function () {

    $(document).on('click', '.iconoModificar', function () {
        button = $(this);

        // let estado = (estadoGrupo == "Activo") ? 1 : (estadoGrupo == "Inactivo") ? 0 : -1;

        $.ajax({
            type: "GET",
            url: "showModalActualizar",
            success: function (data) {
                $('#ModalSection').html(data);

                //Aqui se llenan todos los campos a modificar
                // $('#modalModificarRedes').find('#inputEstadoRed').val(estado); ---> Campo de ejemplo

                $('#modalModificarSemilleros').modal('show');
            }
        });
    });

    $('#BtnRegistrarSemillero').on('click', function () {
        button = $(this);
        $.ajax({
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                $('#ModalSection').html(data);

                $('#modalRegistrarSemilleros').modal('show');
            }
        });
    });


});
