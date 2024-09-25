$(document).ready(function () {
    function reset(n1, n2, b) {
        n1 = 1;
        n2 = 2;
        b = true;
    }

    function campoUnico(nombreCampo) {
        let array = []
        let n1 = 1;
        let b = true;
        while (b) {
            while ($('input[name="' + nombreCampo + '[' + n1 + '][]"]')) {
                array[n1] = $('input[name="' + nombreCampo + '[' + n1 + '][]"]').val();
                n1++;
            }
            b = false;
        }
        return array
    }
    function campoAgregable(nombreCampo) {
        let array = []
        let n1 = 1;
        let n2 = 2;
        let b = true;
        while (b) {
            while ($('input[name="' + nombreCampo + '[' + n1 + '][' + n2 + '][]"]')) {
                array[n1][n2] = $('input[name="' + nombreCampo + '[' + n1 + '][' + n2 + '][]"]').val();
                n2++;
                if (!$('input[name="' + nombreCampo + '[' + n1 + '][' + n2 + '][]"]')) {
                    n1++;
                    n2 = 1;
                }
            }
            b = false;
        }
    }
    //Metodo para abrir la modal de modificar
    let button = '';
    //Metodo para abrir la modal de modificar
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

    $(document).on('click', '#btnModificar', function (e) {
        e.preventDefault();
        let nombre_old = $(button).parents('tr').find('td:eq(0)').text().trim();

        let nombre = $('#inputNombreRed').val();
        let estado = $('#inputEstadoRed').val();
        let estado_text = (estado == 1) ? "Activo" : (estado == 0) ? "Inactivo" : null;

        let token = $('#_token').val();

        $.ajax({
            type: "POST",
            url: "actualizar_redes",
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

    $(document).on('click', '#btnRegistrar', function (e) {
        e.preventDefault();
        let n1 = 1;
        let n2 = 1;
        let b1 = true;

        let ano_proyecto = $('#inputAnoProyecto').val();
        let codigo = $('#inputCodigoSIGP').val();
        let nombre = $('#inputNombreProyecto').val();
        let centros = $('input[name="centros[]"]').map(function () { return $(this).val(); }).get();
        let grupos = $('input[name="grupos[]"]').map(function () { return $(this).val(); }).get();
        let lineas = $('input[name="lineas[]"]').map(function () { return $(this).val(); }).get();
        let redes = $('input[name="redes[]"]').map(function () { return $(this).val(); }).get();
        let programas = $('input[name="programas[]"]').map(function () { return $(this).val(); }).get();
        let semilleros = $('input[name="semilleros[]"]').map(function () { return $(this).val(); }).get();
        let participantes = $('input[name="participantes[]"]').map(function () { return $(this).val(); }).get();
        let resumen = $('#inputResumenProyecto').val();
        let objetivo = $('#inputObjetivoProyecto').val();
        let objetivos_especificos = $('input[name="objetivos_especificos[]"]').map(function () { return $(this).val(); }).get();
        let propuesta = $('#inputPropuesta').val();
        let impacto = $('#inputImpacto').val();
        //Actividades
        let descripciones = campoUnico('descripcion');
        let actividades = campoAgregable('actividades');
        let entregables = campoAgregable('entregables');
        let enlaces = campoUnico('enlace_evidencia');
        let cumplidos = campoAgregable('cumplido');
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
            'cumplidos': cumplidos
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
            url: "crear_redes",
            data: {
                '_token': token,
                'ano_ejecucion': ano_proyecto,
                'codigo': codigo,
                'nombre': nombre,
                'centros': centros,
                'grupos': grupos,
                'lieas': lineas,
                'redes': redes,
                'programas': programas,
                'semilleros': semilleros,
                'participantes': participantes,
                'resumen': resumen,
                'objetivo_general': objetivo,
                'objetivos_especificos': objetivos_especificos,
                'propuesta': propuesta,
                'impacto': impacto,
                'actividades': actividades_conjunto,
                'prespuestos': presupuestos
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
                } else {
                    console.log(error, status);
                }
            }
        });
    });

});

