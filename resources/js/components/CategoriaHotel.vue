<template>
  <div class="container my-5">
    <h2>Hoteles</h2>

    <div class="row">
      <div class="col-md-4 mt-4" v-for="hotel in hoteles" :key="hotel.id">
        <div class="card">
          <img :src="'storage/' + hotel.imagen_principal" :alt="hotel.nombre" />
          <div class="card-body">
            <h3 class="card-title text-primary font-weight-bold">
              {{ hotel.nombre }}
            </h3>
            <p class="card-text">
              {{ hotel.direccion }}
            </p>
            <p class="card-text">
              <span class="font-weight-bold">Horario:</span>
              {{ hotel.apertura }} - {{ hotel.cierre }}
            </p>
            <a href="#" class="btn btn-primary btn-block">Ver Lugar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    hoteles() {
      return this.$store.getters.obtenerHoteles;
    },
  },

  created() {
    axios.get("/api/categorias/hoteles").then((respuesta) => {
      this.$store
        .dispatch("agregarHoteles", respuesta.data)
        .catch((error) => console.log(error));
    });
  },
};
</script>

<style>
</style>