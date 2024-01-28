(() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', (e) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.toggle('was-validated', true);
        });
    });
})();

document.addEventListener('DOMContentLoaded', () => {
    const showPasswordBtn = document.getElementById('showPasswordBtn');
    const passwordInput = document.getElementById('contrasenia');
    if (showPasswordBtn && passwordInput) {
        showPasswordBtn.addEventListener('click', () => {
            const passwordEye = document.getElementById('toogleIcon');
            passwordInput.type = (passwordInput.type === 'password') ? 'text' : 'password';
            passwordEye.classList.toggle('fa-eye-slash');
            passwordEye.classList.toggle('fa-eye');
        });
    }
});

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

function validarDNI(dni) {
    // Expresión regular para validar el formato del DNI
    var regex = /^\d{8}[a-zA-Z]$/;

    if (!regex.test(dni)) {
        return false;
    }

    // Extraer el número y la letra del DNI
    var numero = dni.slice(0, 8);
    var letra = dni.slice(8).toUpperCase();

    // Calcular la letra esperada
    var letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
    var letraEsperada = letras.charAt(numero % 23);
    // Comparar la letra calculada con la letra del DNI
    return letra === letraEsperada;
}

// Ejemplo de uso
/*var dniEjemplo = '';
if (validarDNI(dniEjemplo)) {
    console.log('El DNI es válido.');
} else {
    console.log('El DNI no es válido.');
}*/