<template>
  <div class="container my-5">
    <h1 class="text-center mb-5">{{ establecimiento.nombre }}</h1>

    <div class="row align-items-start">
      <div class="col-md-8 order-2">
        <img
          :src="`../storage/${establecimiento.imagen_principal}`"
          :alt="establecimiento.nombre"
          class="img-fluid shadow rounded"
        />

        <p class="mt-3 text-justify">{{ establecimiento.descripcion }}</p>

        <galeria-imagenes></galeria-imagenes>
      </div>

      <aside class="col-md-4 shadow order-1 p-0">
        <div>
          <MapaUbicacion />
        </div>

        <div class="p-4 bg-primary">
          <h2 class="text-center text-white mb-4">Más Información</h2>

          <p class="text-white mt-1">
            <span class="font-weight-bold">Ubucación:</span>
            {{ establecimiento.direccion }}
          </p>

          <p class="text-white mt-1">
            <span class="font-weight-bold">Barrio:</span>
            {{ establecimiento.colonia }}
          </p>

          <p class="text-white mt-1">
            <span class="font-weight-bold">Horario:</span>
            {{ establecimiento.apertura }} - {{ establecimiento.cierre }}
          </p>

          <p class="text-white mt-1">
            <span class="font-weight-bold">Telefono:</span>
            {{ establecimiento.telefono }}
          </p>
        </div>
      </aside>
    </div>
  </div>
</template>

<script>
import MapaUbicacion from "./MapaUbicacion.vue";
import GaleriaImagenes from "./GaleriaImagenes.vue";

export default {
  components: {
    MapaUbicacion,
    GaleriaImagenes,
  },
  computed: {
    establecimiento() {
      return this.$store.getters.obtenerEstablecimiento;
    },
  },

  methods: {},

  created() {
    const { id } = this.$route.params;
    axios
      .get("/api/establecimientos/" + id)
      .then((respuesta) => {
        this.$store.dispatch("agregarEstablecimiento", respuesta.data);
      })
      .catch((error) => console.log(error));
  },
};
</script>

<style>
</style>