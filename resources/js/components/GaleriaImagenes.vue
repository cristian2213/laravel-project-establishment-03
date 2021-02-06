<template>
  <div v-if="imagenes.length > 0">
    <h2 class="mt-4">Galaeria de Imágenes</h2>

    <ul class="row list-unstyled mt-4">
      <li v-for="imagen in imagenes" :key="imagen.id" class="col-md-4 mb-4">
        <!-- Implementacion de Lightbox  -->
        <a
          :href="`/storage/${imagen.ruta_imagen}`"
          data-lightbox="imagenes"
          data-title="Imagen Establecimiento"
        >
          <img
            :src="`/storage/${imagen.ruta_imagen}`"
            alt="galeria"
            class="img-fluid"
          />
        </a>
      </li>
    </ul>
  </div>
</template>


<script>
import Lightbox from "lightbox2";
export default {
  computed: {
    imagenes() {
      return this.$store.getters.obtenerImagenes;
    },
  },
};
</script>

<style>
@import "https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css";
</style>