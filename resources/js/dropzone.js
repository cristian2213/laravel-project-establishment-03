const { default: axios } = require("axios");

// Configuracion del editor
document.addEventListener("DOMContentLoaded", () => {
    // ejecutar el codigo solo si existe el id
    if (document.getElementById("dropzone")) {
        // Eliminar error de dropzone en consola
        Dropzone.autoDiscover = false;

        const csrf_token = document.querySelector("meta[name=csrf-token]")
            .content; // token para enviar en la request ajax

        const dropzone = new Dropzone("div#dropzone", {
            url: "/imagenes/store", // peticion a la ruta
            dictDefaultMessage: "Sube hasta 10 imagenes",
            maxFiles: 10, // maximo de imagenes
            required: true,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            addRemoveLinks: true, // habilitar el eliminar imagenes

            /* todos los dict son para traduccion */
            dictRemoveFile: "Remover Imagen",

            headers: {
                // pasar siempre el token
                "X-CSRF_TOKEN": csrf_token
            },
            // Se ejecuta cuando se crea la instancia de Dropzone
            init: function() {
                const imagenes = document.querySelectorAll(".galeria");

                if (imagenes.length > 0) {
                    imagenes.forEach(imagen => {
                        const imagenPublicada = {};

                        imagenPublicada.size = 1;
                        imagenPublicada.name = imagen.value;
                        imagenPublicada.nombreImagen = imagen.value;

                        this.options.addedfile.call(this, imagenPublicada);
                        this.options.thumbnail.call(
                            this,
                            imagenPublicada,
                            `/storage/${imagenPublicada.name}`
                        );

                        imagenPublicada.previewElement.classList.add(
                            "dz-success"
                        );

                        imagenPublicada.previewElement.classList.add(
                            "dz-complete"
                        );
                    });
                }
            },

            //* Se ejecuta con la respuesta del servidor
            success: function(file, respuesta) {
                // agregando el nombre de la imagen a dropzone para luego ser usada en el metodo de eliminar
                file.nombreImagen = respuesta.archivo;
            },

            //* se ejecuta enviando la peticion al servidor
            sending: function(file, xhr, formData) {
                const inputDropzone = document.getElementById("uuid").value;

                // agregar datos al formData para enviarlos al servidor
                formData.append("uuid", inputDropzone); // .todo lo que se agrege en este objeto sera recibido en el servidor
            },

            //* Se ejecuta cuando se elimina un archivo
            removedfile: function(file, respuesta) {
                const nombreImg = file.nombreImagen; // accediendo al nombre de la imagen

                console.log(nombreImg);
                const params = {
                    imagen: nombreImg,
                    uuid: document.getElementById("uuid").value
                };

                axios
                    .post("/imagenes/destroy", params)
                    .then(respuesta => {
                        // eliminar imagen del dom, desde el padre hacia el hijo
                        file.previewElement.parentElement.removeChild(
                            file.previewElement
                        );
                    })
                    .catch(error => console.log(error));
            }
        });
    }
});
