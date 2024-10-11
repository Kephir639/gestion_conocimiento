$(document).ready(function () {
    let inputs = document.querySelectorAll('input');
    let selects = document.querySelectorAll('select');

    $.each(inputs, function (clave, input) {
        $(input).attr('disabled');
    });
    $.each(selects, function (clave, select) {
        $(select).attr('disabled');
    });

    $('#btnHabilitar').on('click', function (e) {
        e.preventDefault();

        $.each(inputs, function (clave, input) {
            $(input).attr('disabled').remove();
        });
        $.each(selects, function (clave, select) {
            $(select).attr('disabled').remove();
        });
    });

    document.getElementById('togglePassword').addEventListener('click', function (e) {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');

        // Cambia el tipo de input entre 'password' y 'text'
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false)
            })
    });
    $(document).on('click', '#btnAsignarRol', function (e) {
        button = $(this);
        e.preventDefault();
        let idRol = $('#inputRol').val();
        let token = $('#_token').val();
        let documentosSeleccionados = $('input[name="userCheckbox[]"]:checked').map(function () { return $(this).val(); }).get(); //se busca la data y luego se asigna en la variable
        let estado = $('#inputEstado').val();
        $.ajax({
            type: "POST",
            url: "change_profile",
            data: {
                'idRol': idRol,
                'documentos': documentosSeleccionados,
                'estado_usu': estado,
                '_token': token
            },
            success: function (data) {
                // Mostrar mensaje de éxito en el modal
                $('#alertasModificar').html(data);

            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    // Mostrar errores de validación en los campos correspondientes
                    $.each(errors, function (clave, valor) {
                        $("#div_" + clave).find('.errorValidacion').html(valor);
                    });
                } else {
                    // console.log(error, status);
                }
            }
        });
    });
});
