function toggleFields() {
    const cargo = document.getElementById('cargo').value;
    const aprendizFields = document.getElementById('aprendizFields');
    const profesionFields = document.querySelectorAll('.instructorFields'); // Selector para los campos de instructor

    // Ocultar todos los campos inicialmente
    aprendizFields.style.display = 'none';
    profesionFields.forEach(field => field.style.display = 'none');

    // Mostrar campos según la selección de cargo
    if (cargo == '3') { // Asumiendo que '3' es el ID para "Aprendiz"
        aprendizFields.style.display = 'flex';
    } else if (cargo == '10' || cargo == '2' || cargo == '6') { // Lógica OR para los IDs de "Instructor"
        profesionFields.forEach(field => field.style.display = 'flex');
    }
}

// Escuchar el evento 'change' en el select de cargo
document.getElementById('cargo').addEventListener('change', toggleFields);

