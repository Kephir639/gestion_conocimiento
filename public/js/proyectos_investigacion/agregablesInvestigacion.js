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

    function reiniciarInputs(grupoInputs) { //Funcion para reiniciar la posicion de los inputs[NumeroSeccion][NumeroCampo]
        let contador = 1;
        grupoInputs.each(function () {
            let divContenedor = $(this).find('.input-agregar'); //Array de los divs que contienen los inputs agregables
            let inputSimples = $(this).find('.simple'); //Array de inputs simples
            let nombreCampo = '';
            divContenedor.each(function () {
                let inputAgregables = $(this).find('.agregable'); //Array de inputs agregables
                let contadorCantidad = 1; //Contador para el numero de campo
                inputAgregables.each(function () { //Reiniciamos el valor de las posiciones utilizando los contadores
                    nombreCampo = getNameAttribute($(this));
                    $(this).attr('name', nombreCampo + '[' + contador + '][' + contadorCantidad + '][]');
                    contadorCantidad++;
                });
            });
            inputSimples.each(function () { //Reiniciamos el valor de las posiciones utilizando los contadores
                nombreCampo = getNameAttribute($(this));
                $(this).attr('name', nombreCampo + '[' + contador + '][]');
            });
            contador++;
        });
    }

    $(document).on('click', '#btnAgregarActividad', function (e) { //Metodo para añadir una nueva actividad
        e.preventDefault();
        let div = $(this).closest('#actividades');//Div que contiene todas las actividades

        $.ajax({//Realizamos una peticion ajax para obtener el HTML de la actividad junto con el numero de actividad que le corresponde
            type: "GET",
            url: "agregar_actividad",
            data: {
                'contador_actividad': contadorDivActividad
            },
            success: function (data) {
                //Se agrega una tabla de actividad al DOM
                $(div).append(data);
                //Se aumenta el nunero de actividades actuales
                contadorDivActividad++;
            }
        });
    })

    $(document).on('click', '#btnEliminarActividad', function (e) { //Metodo que elimnina una actividad del DOM
        e.preventDefault();

        $(this).closest('.actividadAgregada').remove(); //Remueve la actividad del DOM
        let grupoInputs = $('#actividades').find('.grupoInput');//Obtiene los inputs que quedan
        reiniciarInputs(grupoInputs); //Reinicia las posiciones de los inputs
        contadorDivActividad--; //Disminuye el numero de actividades actuales
    });

    $(document).on('click', '#btnAgregarPresupuesto', function (e) { //Metodo para agregar un presupuesto
        e.preventDefault();
        let div = $(this).closest('#presupuestos');//Div que contiene los presupuestos
        $.ajax({//Realizamos una peticion ajax para obtener el HTML del presupuesto con su contador correspondiente para las posiciones
            type: "GET",
            url: "agregar_presupuesto",
            data: {
                'contador_presupuesto': contadorDivPresupuesto
            },
            success: function (data) {
                $(div).append(data); //Se agrega el presupuesto al DOM
                contadorDivPresupuesto++; //Aumenta el numero de presupuestos actuales
            }
        });
    });

    $(document).on('click', '#btnEliminarPresupuesto', function (e) { //Metodo par eliminar un presupuesto del DOM
        e.preventDefault();
        $(this).closest('.presupuestoAgregado').remove(); //Se elimina el presupuesto del DOM
        let grupoInputs = $('#presupuestos').find('.grupoInput'); //Grupo de inputs restantes
        reiniciarInputs(grupoInputs); //Se renician las posiciones de los inputs
        contadorDivPresupuesto--; //Disminuye la cantidad de presupuestos actuales
    });
});
