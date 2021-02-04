<template>
  <div class="container my-5">
    <h2>Restaurants</h2>

    <div class="row">
      <div
        class="col-md-4 mt-4"
        v-for="restaurante in restaurantes"
        :key="restaurante.id"
      >
        <div class="card">
          <img
            :src="'storage/' + restaurante.imagen_principal"
            :alt="restaurante.nombre"
          />
          <div class="card-body">
            <h3 class="card-title text-primary font-weight-bold">
              {{ restaurante.nombre }}
            </h3>
            <p class="card-text">
              {{ restaurante.direccion }}
            </p>
            <p class="card-text">
              <span class="font-weight-bold">Horario:</span>
              {{ restaurante.apertura }} - {{ restaurante.cierre }}
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
    restaurantes() {
      return this.$store.getters.obtenerRestaurantes;
    },
  },

  created() {
    axios
      .get("/api/categorias/restaurant")
      .then((respuesta) => {
        this.$store.dispatch("agregarRestaurantes", respuesta.data);
      })
      .catch((error) => console.log(error));
  },
};
</script>

<style>
</style>