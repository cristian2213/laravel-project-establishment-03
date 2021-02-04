<template>
  <div class="container my-5">
    <h2>Cafés</h2>

    <div class="row">
      <div class="col-md-4 mt-4" v-for="cafe in cafes" :key="cafe.id">
        <div class="card">
          <img :src="'storage/' + cafe.imagen_principal" :alt="cafe.nombre" />
          <div class="card-body">
            <h3 class="card-title text-primary font-weight-bold">
              {{ cafe.nombre }}
            </h3>
            <p class="card-text">
              {{ cafe.direccion }}
            </p>
            <p class="card-text">
              <span class="font-weight-bold">Horario:</span>
              {{ cafe.apertura }} - {{ cafe.cierre }}
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
    cafes() {
      return this.$store.getters.obtenerCafes;
    },
  },

  created() {
    axios
      .get("/api/categorias/cafe")
      .then((respuesta) => {
        this.$store.dispatch("agregarCafes", respuesta.data);
      })
      .catch((error) => console.log(error));
  },
};
</script>

<style>
</style>