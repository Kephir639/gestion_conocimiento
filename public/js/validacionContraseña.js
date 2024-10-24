document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});

document.getElementById('togglePasswordConfirmation').addEventListener('click', function () {
    const passwordInput = document.getElementById('password_confirmation');
    const icon = this.querySelector('i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form'); // Selecciona tu formulario
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');

    form.addEventListener('submit', function (e) {
        if (password.value !== passwordConfirmation.value) {
            e.preventDefault(); // Previene el envío del formulario
            alert('Las contraseñas no coinciden.');
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const password = document.getElementById('password');
    const passwordRequirementsList = document.getElementById('passwordRequirements');
    const passwordRequirements = {
        length: document.getElementById('length'),
        uppercase: document.getElementById('uppercase'),
        lowercase: document.getElementById('lowercase'),
        number: document.getElementById('number'),
        special: document.getElementById('special')
    };

    // Mostrar los requisitos cuando el campo esté enfocado
    password.addEventListener('focus', function () {
        passwordRequirementsList.style.display = 'block';
    });

    // Ocultar los requisitos cuando el campo pierda el foco
    password.addEventListener('blur', function () {
        passwordRequirementsList.style.display = 'none';
    });

    // Validación en tiempo real mientras el usuario escribe
    password.addEventListener('input', function () {
        const value = password.value;

        // Longitud entre 8 y 15 caracteres
        if (value.length >= 8 && value.length <= 15) {
            passwordRequirements.length.classList.remove('text-danger');
            passwordRequirements.length.classList.add('text-success');
        } else {
            passwordRequirements.length.classList.remove('text-success');
            passwordRequirements.length.classList.add('text-danger');
        }

        // Al menos una letra mayúscula
        if (/[A-Z]/.test(value)) {
            passwordRequirements.uppercase.classList.remove('text-danger');
            passwordRequirements.uppercase.classList.add('text-success');
        } else {
            passwordRequirements.uppercase.classList.remove('text-success');
            passwordRequirements.uppercase.classList.add('text-danger');
        }

        // Al menos una letra minúscula
        if (/[a-z]/.test(value)) {
            passwordRequirements.lowercase.classList.remove('text-danger');
            passwordRequirements.lowercase.classList.add('text-success');
        } else {
            passwordRequirements.lowercase.classList.remove('text-success');
            passwordRequirements.lowercase.classList.add('text-danger');
        }

        // Al menos un número
        if (/\d/.test(value)) {
            passwordRequirements.number.classList.remove('text-danger');
            passwordRequirements.number.classList.add('text-success');
        } else {
            passwordRequirements.number.classList.remove('text-success');
            passwordRequirements.number.classList.add('text-danger');
        }

        // Al menos un carácter especial
        if (/[!@#$%^&*(),.?":{}|<>]/.test(value)) {
            passwordRequirements.special.classList.remove('text-danger');
            passwordRequirements.special.classList.add('text-success');
        } else {
            passwordRequirements.special.classList.remove('text-success');
            passwordRequirements.special.classList.add('text-danger');
        }
    });
});
