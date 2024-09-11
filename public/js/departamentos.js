
document.addEventListener('DOMContentLoaded', function () {
    // Elementos del DOM
    const departamentoSelect = document.getElementById('departamento');
    const municipioSelect = document.getElementById('municipio');

    // Evento change para el select de departamento
    departamentoSelect.addEventListener('change', function () {
        const departamentoId = this.value;

        // Limpia el select de municipios
        municipioSelect.innerHTML = '<option value="" selected>Seleccione...</option>';

        // Verifica si un departamento ha sido seleccionado
        if (departamentoId) {
            // Realiza la solicitud Ajax
            fetch(`/get-municipios/${departamentoId}`)
                .then(response => response.json())
                .then(data => {
                    // Agrega los municipios al select
                    data.forEach(municipio => {
                        const option = document.createElement('option');
                        option.value = municipio.id_municipio;
                        option.textContent = municipio.municipio;
                        municipioSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    });
});
