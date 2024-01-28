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
