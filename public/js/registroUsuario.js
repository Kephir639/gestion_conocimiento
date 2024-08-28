document.getElementById('cargo').addEventListener('change', function() {
    var aprendizFields = document.getElementById('aprendizFields');
    if (this.value == 'aprendiz') {
        aprendizFields.style.display = 'block';
    } else {
        aprendizFields.style.display = 'none';
    }
});