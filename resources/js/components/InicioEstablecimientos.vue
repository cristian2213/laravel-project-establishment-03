<template>
  <div>
    <mapa-establecimientos></mapa-establecimientos>
    <categoria-cafe></categoria-cafe>
    <categoria-restaurant></categoria-restaurant>
    <categoria-hotel></categoria-hotel>
  </div>
</template>


<script>
import MapaEstablecimientos from "./MapaEstablecimientos";
import CategoriaCafe from "./CategoriaCafe";
import CategoriaRestaurant from "./CategoriaRestaurant";
import CategoriaHotel from "./CategoriaHotel";

export default {
  components: {
    MapaEstablecimientos,
    CategoriaCafe,
    CategoriaRestaurant,
    CategoriaHotel,
  },
};
</script>

<style>
</style>