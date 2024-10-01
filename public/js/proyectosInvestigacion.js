$(document).ready(function () {

    function campoUnico(nombreCampo) {
        let array = [];
        let n1 = 1;
        while ($('input[name="' + nombreCampo + '[' + n1 + '][]"]').length > 0) {
            array.push($('input[name="' + nombreCampo + '[' + n1 + '][]"]').val());
            n1++;
        }
        return array;
    }

    function campoAgregable(nombreCampo) {
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
    let button = '';

    $(document).on('click', '.btnAgregar', function (e) {
        e.preventDefault();
        let inputs = $(this).closest('.input-agregar').find('.agregable');
        let name = $(inputs[inputs.length-1]).attr('name');
        let partes = name.split("[");
        let posiciones = [];
        for (var i = 1; i < partes.length - 1; i++) {
            posiciones.push(parseInt(partes[i].replace("]", "")));
        }
        let posLlave = name.indexOf("[");
        let nombreCampo = name.substr(0, posLlave);

        let divObjetivo = $(this).closest('.input-agregar');

        let item = `
        <div class="divAgregado">
            <input type="text" class="form-control agregable" name="`+nombreCampo+`[`+posiciones[0]+`][`+(posiciones[1]+1)+`][]"
                                                    required><a href="#" class="btn btn-danger p-2 btnEliminar">-</a>
        </div>
        `;

        $(divObjetivo).append(item);
    });

    $(document).on('click', '.btnEliminar', function (e) {
        e.preventDefault();
        let agregados = $(this).closest('.input-agregar').find('.agregable');
        // Asegurarse de que no se elimine el último objetivo
        if (agregados.length > 1) {
            let name = $(this).closest('.divAgregado').find('.agregable').attr('name');
            let partes = name.split("[");
            let posiciones = [];
            for (var i = 1; i < partes.length - 1; i++) {
                posiciones.push(parseInt(partes[i].replace("]", "")));
            }
            let posLlave = name.indexOf("[");
            let nombreCampo = name.substr(0, posLlave);

            $(this).closest('.divAgregado').remove();

            let agregados = $(this).closest('.input-agregar').find('.agregable');
            let reinicio = 1;
            $.each(agregados, function (llave, valor) {
                $(agregados).attr('name').replace(nombreCampo+'['+posiciones[0]+']['+reinicio+']');
                reinicio++;
            });
        }
    });

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

    // $(document).on('click', '.btnAgregar', function (e) {

    // });

    $(document).on('click', '#btnRegistrar', function (e) {
        e.preventDefault();
        console.log('Funciona')
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
            url: "crear_proyecto_investigacion",
            data: {
                '_token': token,
                'ano_ejecucion': ano_proyecto,
                'codigo_sigp': codigo,
                'nombre_proyecto': nombre,
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
                'impacto_esperado': impacto,
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

