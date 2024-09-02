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
});
