import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,

    init: function() {
        // Mostrar imagen previamente guardada (útil para editar posts)
        const imagenActual = document.querySelector('[name="imagen"]').value.trim();

        if (imagenActual) {
            const imagenPublicada = {
                size: 1234,
                name: imagenActual
            };

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
            imagenPublicada.previewElement.classList.add("dz-success", "dz-complete");
        }
    },

    success: function(file, response) {
        // 👇 Guardamos el nombre devuelto por Laravel
        document.querySelector('[name="imagen"]').value = response.imagen;
    },

    error: function(file, message) {
        console.error(message);
    }
});

