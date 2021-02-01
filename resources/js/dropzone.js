// Configuracion del editor
document.addEventListener("DOMContentLoaded", () => {
    // ejecutar el codigo solo si existe el id
    if (document.getElementById("dropzone")) {
        // Eliminar error de dropzone en consola
        Dropzone.autoDiscover = false;

        const csrf_token = document.querySelector("meta[name=csrf-token]")
            .content; // token para enviar en la request ajax

        const dropzone = new Dropzone("div#dropzone", {
            url: "/imagenes/store",
            dictDefaultMessage: "Sube hasta 10 imagenes",
            maxFiles: 10,
            required: true,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            headers: {
                // pasar el token por headers
                "X-CSRF_TOKEN": csrf_token
            },

            success: function(file, response) {
                console.log(response);
            },

            sending: function(file, xhr, formData) {
                const inputDropzone = document.getElementById("uuid").value;

                // agregar datos al formData para enviarlos al servidor
                formData.append("uuid", inputDropzone); // .todo lo que se agrege en este objeto sera recibido en el servidor
            }
        });
    }
});
