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
    $(document).on('click', '#btnActualizar', function (e) {
        e.preventDefault();

        // Recoger los valores de los campos
        let token = $('meta[name="csrf-token"]').attr('content');  // Tomar el token desde meta tag
        let nombre = $('#name').val();
        let apellido = $('#apellidos').val();
        let tipo_documento = $('#tipo_documento').val();
        let identificacion = $('#numero_identificacion').val();
        let genero = $('#genero').val();
        let tipo_poblacion = $('#tipo_poblacion').val();
        let email = $('#email').val();
        let celular = $('#celular').val();
        let departamento = $('#departamento').val();
        let municipio = $('#municipio').val();
        let direccion = $('#direccion').val();

        $.ajax({
            type: "POST",
            url: "change_profile",
            data: {
                '_token': token,  // Enviar el token correctamente
                'name': nombre,
                'apellido': apellido,
                'tipo_documento': tipo_documento,
                'identificacion': identificacion,
                'genero': genero,
                'tipo_poblacion': tipo_poblacion,
                'email': email,
                'celular': celular,
                'departamento': departamento,
                'municipio': municipio,
                'direccion': direccion
            },
            success: function (data) {
                $('#alertasModificar').html(data);  // Mostrar mensaje de éxito
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (clave, valor) {
                        $("#div_" + clave).find('.errorValidacion').html(valor);
                    });
                } else {
                    // Manejo de otros errores
                }
            }
        });
    });


});
