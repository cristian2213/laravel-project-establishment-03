<template>
  <div>
    <categoria-cafe></categoria-cafe>
    <categoria-restaurant></categoria-restaurant>
    <categoria-hotel></categoria-hotel>
  </div>
</template>


<script>
import CategoriaCafe from "./CategoriaCafe.vue";
import CategoriaRestaurant from "./CategoriaRestaurant.vue";
import CategoriaHotel from "./CategoriaHotel.vue";

export default {
  components: {
    CategoriaCafe,
    CategoriaRestaurant,
    CategoriaHotel,
  },
};
</script>

<style>
</style>