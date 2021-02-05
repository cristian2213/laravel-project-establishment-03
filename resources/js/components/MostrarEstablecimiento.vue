<template>
  <div class="container my-5">
    <h1>{{ establecimiento.nombre }}</h1>
  </div>
</template>

<script>
export default {
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