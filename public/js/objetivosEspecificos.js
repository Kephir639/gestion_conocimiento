$(document).ready(function () {
    // Función para agregar un nuevo objetivo específico
    $(document).on('click', '.btnAddObjetivo', function (e) {
        e.preventDefault();

        // Crear un nuevo input de objetivo específico
        let nuevoObjetivo = `
        <div class="input-group mb-3 objetivo-item">
            <input type="text" class="form-control" name="objetivos_especificos[]" placeholder="Objetivo específico" required>
            <button class="btn btn-danger btnRemoveObjetivo" type="button">-</button>
        </div>`;

        // Agregar el nuevo objetivo específico después del elemento actual
        $('#objetivosEspecificosContainer').append(nuevoObjetivo);
    });

    // Función para eliminar un objetivo específico
    $(document).on('click', '.btnRemoveObjetivo', function (e) {
        e.preventDefault();

        // Asegurarse de que no se elimine el último objetivo
        if ($('.objetivo-item').length > 1) {
            $(this).closest('.objetivo-item').remove();
        }
    });
});
