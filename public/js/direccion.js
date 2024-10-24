document.addEventListener("DOMContentLoaded", function () {
    const tipoVia = document.getElementById('tipo_via');
    const direccionCarrera = document.getElementById('direccion_carrera');
    const direccionNumero1 = document.getElementById('direccion_numero1');
    const direccionNumero2 = document.getElementById('direccion_numero2');
    const direccionPreview = document.getElementById('direccion_preview');
    const form = document.querySelector("form");

    // Función para actualizar la previsualización
    function actualizarPrevisualizacion() {
        const tipo = tipoVia.value;
        const carrera = direccionCarrera.value || '';
        const numero1 = direccionNumero1.value || '';
        const numero2 = direccionNumero2.value || '';

        direccionPreview.textContent = `${tipo} ${carrera} #${numero1}-${numero2}`;
    }

    // Llamar a la función cuando cambian los valores
    tipoVia.addEventListener('change', actualizarPrevisualizacion);
    direccionCarrera.addEventListener('input', actualizarPrevisualizacion);
    direccionNumero1.addEventListener('input', actualizarPrevisualizacion);
    direccionNumero2.addEventListener('input', actualizarPrevisualizacion);

    // Actualizar previsualización cuando se carga la página
    actualizarPrevisualizacion();

    // Combinar valores en un campo hidden al enviar el formulario
    form.addEventListener("submit", function (event) {
        const tipo = tipoVia.value;
        const carrera = direccionCarrera.value;
        const numero1 = direccionNumero1.value;
        const numero2 = direccionNumero2.value;

        const direccionCompleta = `${tipo} ${carrera} #${numero1}-${numero2}`;

        // Crear un input hidden para enviar la dirección completa
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'direccion';
        hiddenInput.value = direccionCompleta;

        form.appendChild(hiddenInput);
    });
});