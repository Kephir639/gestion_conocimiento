$(document).ready(function () {
    $(document).on('click', '.btnEliminar', function (e) {
        e.preventDefault();
        let agregados = $(this).closest('.input-agregar').find('.agregable');//Compruebo si se agregaron campos
        console.log(agregados);
        if (agregados.length > 1) {
            let name = $(this).closest('.divAgregado').find('.agregable').attr('name');
            let partes = name.split("[");
            let posiciones = [];
            for (var i = 1; i < partes.length - 1; i++) {
                posiciones.push(parseInt(partes[i].replace("]", "")));
            }
            let posLlave = name.indexOf("[");
            let nombreCampo = name.substr(0, posLlave);
            let divAbuelo = $(this).closest('.input-agregar');
            $(this).closest('.divAgregado').remove(); //Elimino el campo seleccionado
            let restante = $(divAbuelo).find('.agregable') //Encuentro los campos que quedaron

            let reinicio = 1;
            $.each(restante, function (llave, valor) {
                $(valor).attr('name', nombreCampo + '[' + posiciones[0] + '][' + reinicio + '][]'); //Reinicio el valor de las posiciones de los campos restantes
                reinicio++;
            });
        }
    });

    $(document).on('click', '.btnAgregar', function (e) {
        e.preventDefault();
        let inputs = $(this).closest('.input-agregar').find('.agregable'); //Encuentra los inputs agregables
        console.log(inputs);
        let name = $(inputs[inputs.length - 1]).attr('name');// Encuentra el atributo name del ultimo input agregado
        let partes = name.split("["); //divide el string con el atributo Name
        let posiciones = [];
        for (var i = 1; i < partes.length - 1; i++) {
            posiciones.push(parseInt(partes[i].replace("]", "")));//Obtenemos las posiciones del input [NumeroGrupo][NumeroCampo]
        }
        let posLlave = name.indexOf("[");
        let nombreCampo = name.substr(0, posLlave); //Extraigo el nombre del input sin las posiciones

        let divObjetivo = $(this).closest('.input-agregar'); //Encuentro el divPadre que contiene los divAgregado

        let item = `
            <div class="divAgregado input-group">
                <input type="text" class="form-control agregable" name="`+ nombreCampo + `[` + posiciones[0] + `][` + (posiciones[1] + 1) + `][]"
                required><a href="#" class="btn btn-danger btnEliminar">-</a>
                <span class="errorValidacion"></span>
            </div>
        `;

        $(divObjetivo).append(item); //Agrego el nuevo input
    });

    $(document).on('click', '.btnAgregarObjetivo', function (e) {
        e.preventDefault();
        // Crear un nuevo input de objetivo específico
        let nuevoObjetivo = `
        <div class="input-group mb-3 objetivo-item">
            <input type="text" class="form-control" name="objetivos_especificos[]" placeholder="Objetivo específico" required>
            <button class="btn btn-danger btnEliminarObjetivo" type="button">-</button>
        </div>`;

        // Agregar el nuevo objetivo específico después del elemento actual
        $('#div_objetivos_especificos').append(nuevoObjetivo);
    });

    $(document).on('click', '.btnEliminarObjetivo', function (e) {
        e.preventDefault();

        // Asegurarse de que no se elimine el último objetivo
        if ($('.objetivo-item').length > 1) {
            $(this).closest('.objetivo-item').remove();
        }
    });
});
