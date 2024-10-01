$(document).ready(function () {
    let button = '';
    //Metodo para abrir la modal de modificar
    $(document).on('click', '#iconoModificar', function () {
        button = $(this);

        let nombreRol = $(this).parents('tr').find('td:eq(0)').text().trim();
        let estadoRol = $(this).parents('tr').find('td:eq(1)').text().trim();

        let estado = (estadoRol == "Activo") ? 1 : (estadoRol == "Inactivo") ? 0 : -1;

        $.ajax({
            type: "GET",
            url: "permisoRol",
            data: {
                'nombre_rol': nombreRol
            },
            success: function (data) {
                let permisos = data.permisos;
                let rol = data.id_rol;

                $.ajax({
                    type: "POST",
                    url: "showModalActualizar",
                    data: {
                        'permisos': permisos,
                        'id_rol': rol
                    },
                    success: function (data) {
                        $('#ModalSection').html(data.modal);

                        $(this).find('#inputNombreRol').val(nombreRol);
                        $(this).find('#inputEstadoRol').val(estado);

                        $('#modalModificarRol').modal('show');
                    }
                });
            }
        });
    });

    $(document).on('click', '#BtnRegistrarRol', function () {
        button = $(this);
        $.ajax({
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                console.log('registrar');
                console.log(data.modal);
                $(document).find('#ModalSection').html(data.modal);
                $('#modalRegistrarRol').modal('show');
            }
        });
    });

    $(document).on('click', '#btnActualizar', function (e) {
        e.preventDefault();

        $.ajax({
            type: "GET",
            url: "funciones",
            success: function (dataGET) {
                let nombre = $('#inputNombreRol').val();
                let nombre_old = $(this).parents('tr').find('td:eq(0)').text().trim();
                let estado = $('#inputEstadoRol').val();
                let token = $('#_token').val();
                let funciones = dataGET; //Antes de actualizar
                let funciones_actualizadas = [];
                $('input[type="checkbox"][name="checkFunciones[]"]:checked').each(function () {
                    funciones_actualizadas.push(this.value);
                });
                let funcionesAgregadas = null;
                let funcionesEliminadas = null;
                funcionesAgregadas = funciones_actualizadas.filter((funcion) => !funciones.includes(funcion));
                funcionesEliminadas = funciones.filter((funcion) => !funciones_actualizadas.includes(funcion));
                // for (funcion of funciones_actualizadas) {
                // }
                // for (funcion of funciones) {
                // }

                $.ajax({
                    type: "POST",
                    url: "actualizarRol",
                    data: {
                        'nombre_rol': nombre,
                        'estado_rol': estado,
                        'funciones_agregadas': funcionesAgregadas,
                        'funciones_eliminadas': funcionesEliminadas,
                        'nombre_rol_old' : nombre_old,
                        '_token': token
                    },
                    success: function (dataPost) {
                        $('#alertasModificar').html(dataPost);
                        $(button).parents('tr').find('td:eq(0)').text(nombre);
                        $(button).parents('tr').find('td:eq(1)').val(estado);
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
            }
        });
    });

    $(document).on('click', '#btnRegistrar', function () {
        let nombre_rol = $('inputNombreRol').text().trim();
        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "registrarRol",
            data: {
                'nombre_rol': nombre_rol,
                '_token': token
            },
            success: function (response) {
                //Mostrar los registros actualizados
                $('#tablebody_roles').html(data.tabla);

                //Mostrar Alerta
                $('#alertasRegistrar').html(data.alerta);
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (clave, valor) {
                        $("#div_" + clave).find('.errorValidacion').html(valor);
                    });
                } else {
                    console.log(error, status);
                }
            }
        });
    });

});
