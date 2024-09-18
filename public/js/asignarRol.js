$(document).ready(function () {

    $(document).on('click', '.btnAsignar', function (e) {
        e.preventDefault();
        console.log('Botón asignar clickeado'); // Para verificar si el click funciona
        $.ajax({
            type: 'GET',
            url: 'showModalAsignarRol',  // La URL de la ruta
            // Pasar el ID del usuario
            success: function (data) {
                $('#ModalSection').html(data);  // Cargar el contenido del modal
                $('#modalAsignarRol').modal('show');  // Mostrar el modal
            }
        });
    });
});