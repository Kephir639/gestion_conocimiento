$(document).ready(function () {
    let button = '';

    $(document).on('click', '.iconoModificar', function () { //Funcion para mostrar la modal de actualizar cargo
        button = $(this);//Establecemos el punto de referencia
        let nombreCargo = $(this).parents('tr').find('td:eq(0)').text().trim();//Sacamos la informacion de la tabla
        let estadoCargo = $(this).parents('tr').find('td:eq(1)').text().trim();//Sacamos la informacion de la tabla
        let estado = (estadoCargo == "Activo") ? 1 : (estadoCargo == "Inactivo") ? 0 : -1;
        $.ajax({//Utilizamos una solicitud ajax para obtener la modal del controlador
            type: 'GET',
            url: 'showModalActualizar',
            success: function (data) {
                //Ponemos la modal en el DOM
                $('#ModalSection').html(data);
                //Cargamos la informacion
                $('#modalModificarCargo').find('#inputNombreCargo').val(nombreCargo);
                $('#modalModificarCargo').find('#inputEstadoCargo').val(estado);
                //Mostramos la modal
                $('#modalModificarCargo').modal('show');
            }
        });
    });

    //Metodo para abrir la modal de registrar
    $(document).on('click', '#BtnRegistrarCargo', function () {
        button = $(this);//Establecemos el punto de referencia
        $.ajax({//Utilizamos una solicitud ajax para obtener la modal del controlador
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                //Ponemos la modal en el DOM
                $('#ModalSection').html(data);
                //Mostramos la modal
                $('#modalRegistrarCargo').modal('show');
            }
        });
    });

    $(document).on('click', '#btnActualizar', function (e) {//Funcion para actualizar la informacion        
        e.preventDefault();
        //Obtenemos un dato de referencia de la tabla sin actualizar
        let nombre_old = button.parents('tr').find('td:eq(0)').text().trim();
        //Sacamos la informacion de los inputs y las ponemos en variables
        let nombre_cargo = $('#inputNombreCargo').val();
        let estado = $('#inputEstadoCargo').val();
        let estado_cargo = (estado == 1) ? "Activo" : (estado == 0) ? "Inactivo" : "Seleccione una opcion...";
        //Obtenemos el token de autenticacion(Input Hidden)
        let token = $('#_token').val();

        $.ajax({//Realizamos una solicitud ajax para enviar la informacion al controlador para la actualizacion
            type: "POST",
            url: "actualizar_cargos",
            data: {
                '_token': token,
                'nombre_cargo': nombre_cargo,
                'nombre_cargo_old': nombre_old,
                'estado_cargo': estado
            },
            success: function (data) {
                $('#alertasModificar').html(data.alerta);//Mostramos el alerta que corresponda al caso
                $('#tabla_cargos').html(data.tabla)//Ponemos la tabla actualizada en el DOM
            },
            error: function (xhr, status, error) {//En caso de recibir un error
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors; //Obtenemos los errores de la validacion

                    $.each(errors, function (clave, valor) {
                        //Mostramos los errores correspondientes en cada input
                        $("#div_" + clave).find('.errorValidacion').html(valor);
                    });
                }
            }
        });
    });

    $(document).on('click', '#btnRegistrar', function (e) { //Funcion para registrar un cargo
        e.preventDefault();
        //Obtenemos los datos de los input y los ponemos en variables
        let nombre = $('#inputNombreCargo').val();
        //Obtenemos el token de autenticacion(Input Hidden)
        let token = $('#_token').val();

        $.ajax({//Realizamos una solicitud ajax para enviar la informacion al controlador para el registro
            type: "POST",
            url: "crear_cargos",
            data: {
                '_token': token,
                'nombre_cargo': nombre,
            },
            success: function (data) {
                //Mostrar los registros actualizados                
                $('#tablebody_cargos').html(data.tabla);
                //Mostrar Alerta
                $('#alertasRegistrar').html(data.alerta);
            },
            error: function (xhr, status, error) { //En caso de recibir un error
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors; //Obtenemos los errores de la validacion

                    $.each(errors, function (clave, valor) {
                        //Mostramos los errores correspondientes en cada input
                        $("#div_" + clave).find('.errorValidacion').html(valor);
                    });
                }
            }
        });
    });
});
