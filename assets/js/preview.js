document.addEventListener('DOMContentLoaded', () => {
    const inputImagen = document.getElementById('imagen-input');
    const imagenPreview = document.getElementById('imagen-preview');

    if (inputImagen && imagenPreview) {
        inputImagen.addEventListener('change', (e) => {
            previewImage(imagenPreview, inputImagen, e.target);
        });
    }
});

function previewImage(imagenPreview, inputImagen, input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = (e) => {
            imagenPreview.src = e.target.result;
        };
        reader.readAsDataURL(inputImagen.files[0]);
    }
}
