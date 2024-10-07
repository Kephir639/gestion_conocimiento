$(document).ready(function () {
    let button = '';

    function getName(input) { //Obtiene el atributo Name del input seleccionado
        let nombre = $(input).attr('name');
        let partes = nombre.split('[');
        nombreCampo = partes[0];

        return nombreCampo;
    }

    function campoUnico(nombreCampo, tipo) { //Crea un array con los valores de los inputs que no son agregables
        let array = [];
        let n1 = 1;
        while ($(tipo + '[name="' + nombreCampo + '[' + n1 + '][]"]').length > 0) {
            array.push($(tipo + '[name="' + nombreCampo + '[' + n1 + '][]"]').val());
            n1++;
        }
        return array;
    }

    function campoAgregable(nombreCampo) { //Crea una serie de arrays con los valores de los inputs agregables
        let array = [];
        let n1 = 1;
        while ($('input[name="' + nombreCampo + '[' + n1 + '][1][]"]').length > 0) {
            let fila = [];
            let n2 = 1;
            while ($('input[name="' + nombreCampo + '[' + n1 + '][' + n2 + '][]"]').length > 0) {
                fila.push($('input[name="' + nombreCampo + '[' + n1 + '][' + n2 + '][]"]').val());
                n2++;
            }
            array.push(fila);
            n1++;
        }
        return array;
    }

    function validarCamposMultiples(nombre) {
        let primario = $(document).find('#' + nombre);
        let inputs = $(primario).find('input');
        let errors = [];

        for (i = 0; i < inputs.length; i++) {
            if (!$(inputs[i]).val()) {
                if (!(errors[inputs[i]])) {
                    errors[inputs[i]] = "El campo" + getName(inputs[i]) + "es obligatorio"
                }
            }
        }
        return errors;
    }

    $(document).on('click', '.iconoModalModificar', function () {
        button = $(this);
        let nombreGrupo = $(this).parents('tr').find('td:eq(0)').text().trim();
        let estadoGrupo = $(this).parents('tr').find('td:eq(1)').text().trim();
        let estado = (estadoGrupo == "Activo") ? 1 : (estadoGrupo == "Inactivo") ? 0 : -1;
        $.ajax({
            type: "GET",
            url: "showModalActualizar",
            success: function (data) {
                $('#ModalSectionActualizar').html(data);
                $('#modalModificarRedes').find('#inputNombreRed').val(nombreGrupo);
                $('#modalModificarRedes').find('#inputEstadoRed').val(estado);

                $('#modalModificarRedes').modal('show');
            }
        });
    });

    $(document).on('click', '#btnModificar', function (e) {
        e.preventDefault();
        let nombre_old = $(button).parents('tr').find('td:eq(0)').text().trim();

        let nombre = $('#inputNombreRed').val();
        let estado = $('#inputEstadoRed').val();
        let estado_text = (estado == 1) ? "Activo" : (estado == 0) ? "Inactivo" : null;

        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "actualizar_proyecto_investigacion",
            data: {
                '_token': token,
                'nombre_red': nombre,
                'nombre_red_old': nombre_old,
                'estado_red': estado
            },
            success: function (data) {
                $('#alertasModificar').html(data);
                $(button).parents('tr').find('td:eq(0)').text(nombre);
                $(button).parents('tr').find('td:eq(1)').text(estado_text);
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

    //Metodo para abrir la modal de registrar
    $(document).on('click', '#BtnRegistrarProyecto', function () {
        button = $(this);
        $.ajax({
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                $('#ModalSection').html(data);
                $('#modalRegistrarProyectoInvestigacion').modal('show');
            }
        });
    });

    //Funcion para registrar un proyecto
    $(document).on('click', '#btnRegistrar', function (e) {
        e.preventDefault();
        console.log('Funciona')
        let n1 = 1;
        let n2 = 1;
        let b1 = true;

        let ano_proyecto = $('#inputAnoProyecto').val();
        let codigo = $('#inputCodigoSIGP').val();
        let nombre = $('#inputNombreProyecto').val();
        let centros = $('select[name="centros[]"]').map(function () { return $(this).val(); }).get(); //Recorre el array de elementos seleccionados y los guarda en otro array
        let grupos = $('select[name="grupos[]"]').map(function () { return $(this).val(); }).get();
        let lineas = $('select[name="lineas[]"]').map(function () { return $(this).val(); }).get();
        let redes = $('select[name="redes[]"]').map(function () { return $(this).val(); }).get();
        let programas = $('select[name="programas[]"]').map(function () { return $(this).val(); }).get();
        let semilleros = $('select[name="semilleros[]"]').map(function () { return $(this).val(); }).get();
        let participantes = $('select[name="participantes[]"]').map(function () { return $(this).val(); }).get();
        let resumen = $('#inputResumenProyecto').val();
        let objetivo = $('#inputObjetivoProyecto').val();
        let objetivos_especificos = $('input[name="objetivos_especificos[]"]').map(function () { return $(this).val(); }).get();
        let propuesta = $('#inputPropuesta').val();
        let impacto = $('#inputImpacto').val();
        //Actividades
        let descripciones = campoUnico('descripcion', 'input');
        let actividades = campoAgregable('actividades', 'input');
        let entregables = campoAgregable('entregables', 'input');
        let enlaces = campoUnico('enlace_evidencia', 'input');
        let cumplidos = campoUnico('cumplido', 'select');
        let observaciones = campoAgregable('observaciones');
        //Presupuestos
        let conceptos = campoUnico('concepto');
        let rubros = campoUnico('rubro');
        let usos_presupuestales = campoUnico('uso_presupuestal');
        let valores = campoAgregable('valor_planteado');

        let actividades_conjunto = {
            'descripciones': descripciones,
            'actividades': actividades,
            'entregables': entregables,
            'enlaces': enlaces,
            'cumplidos': cumplidos,
            'observaciones': observaciones
        }
        let presupuestos = {
            'conceptos': conceptos,
            'rubros': rubros,
            'uso_presupuestal': usos_presupuestales,
            'valores': valores
        }
        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "crear_proyecto_investigacion",
            data: {
                '_token': token,
                'ano_ejecucion': ano_proyecto,
                'codigo_sigp': codigo,
                'nombre_proyecto': nombre,
                'centros': centros,
                'grupos': grupos,
                'lineas': lineas,
                'redes': redes,
                'programas': programas,
                'semilleros': semilleros,
                'participantes': participantes,
                'resumen': resumen,
                'objetivo_general': objetivo,
                'objetivos_especificos': objetivos_especificos,
                'propuesta': propuesta,
                'impacto_esperado': impacto,
                'actividades': actividades_conjunto,
                'presupuestos': presupuestos
            },
            beforeSend: function () {
                if (validarCamposMultiples().length > 0) {
                    throw new Error('Errores de validacion');
                }
            },
            success: function (data) {
                //Mostrar los registros actualizados
                $('#tablebody_redes').html(data.tabla);
                //Mostrar Alerta
                $('#alertasRegistrar').html(data.alerta);
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (clave, valor) {
                        $("#div_" + clave).find('.errorValidacion').html(valor);
                    });
                } else if (xhr.responseText == "Errores de validacion") {
                    let errors = validarCamposMultiples();

                    $.each(errors, function (clave, valor) {
                        $("#div_" + clave).find('.errorValidacion').html(valor);
                    });
                } else {
                    console.log(error);
                }
            }
        });
    });


});

