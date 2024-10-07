$(document).ready(function () {
    //COntadores utilizados para definir las posiciones en el formulario de las actividades y presupuestos
    let contadorDivActividad = 2;
    let contadorDivPresupuesto = 2;

    function getNameAttribute(input) { //Obtiene el atributo Name del input seleccionado
        let nombre = $(input).attr('name');
        let partes = nombre.split('[');
        nombreCampo = partes[0];

        return nombreCampo;
    }

    function reiniciarInputs(grupoInputs) { //Funcion para reiniciar la posicion de los inputs[NumeroGrupo][NumeroCampo]
        grupoInputs.each(function () {
            let divContenedor = $(this).find('.input-agregar');
            let inputSimples = $(this).find('.simple');
            let nombreCampo = '';
            divContenedor.each(function () {
                let inputAgregables = $(this).find('.agregable');
                let contadorCantidad = 1;
                inputAgregables.each(function () {
                    nombreCampo = getNameAttribute($(this));
                    $(this).attr('name', nombreCampo + '[' + contador + '][' + contadorCantidad + '][]');
                    contadorCantidad++;
                });
            });
            inputSimples.each(function () {
                nombreCampo = getNameAttribute($(this));
                $(this).attr('name', nombreCampo + '[' + contador + '][]');
            });

            contador++;
        });
    }

    $(document).on('click', '#btnAgregarActividad', function (e) {
        e.preventDefault();
        let div = $(this).closest('#actividades');

        $.ajax({
            type: "GET",
            url: "agregar_actividad",
            data: {
                'contador_actividad': contadorDivActividad
            },
            success: function (data) {
                $(div).append(data); //Se agrega una tabla de actividad al DOM
                contadorDivActividad++; //Se aumenta el nunero de actividades actuales
            }
        });
    })

    $(document).on('click', '#btnEliminarActividad', function (e) {
        e.preventDefault();

        let contador = 1;
        $(this).closest('.actividadAgregada').remove();
        let grupoInputs = $('#actividades').find('.grupoInput');
        reiniciarInputs(grupoInputs);
        contadorDivActividad--;
    });

    $(document).on('click', '#btnAgregarPresupuesto', function (e) {
        e.preventDefault();
        let div = $(this).closest('#presupuestos');

        $.ajax({
            type: "GET",
            url: "agregar_presupuesto",
            data: {
                'contador_presupuesto': contadorDivPresupuesto
            },
            success: function (data) {
                $(div).append(data);
                contadorDivPresupuesto++;
            }
        });
    });

    $(document).on('click', '#btnEliminarPresupuesto', function (e) {
        e.preventDefault();

        let contador = 1;
        $(this).closest('.presupuestoAgregado').remove();
        let grupoInputs = $('#presupuestos').find('.grupoInput');
        reiniciarInputs(grupoInputs);
        contadorDivPresupuesto--;
    });
});
