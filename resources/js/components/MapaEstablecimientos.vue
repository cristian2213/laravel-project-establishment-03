<template>
  <div class="mapa">
    <!-- //! Falta agregar la ubicacion de los establecimientos al mapa y programar los metodos   -->
    <l-map :zoom="zoom" :center="center" :options="mapOptions">
      <LTileLayer :url="url" :attribution="attribution" />
      <l-marker></l-marker>
    </l-map>
  </div>
</template>

<script>
import { latLng } from "leaflet";
import { LMap, LTileLayer, LMarker, LTooltip, LIcon } from "vue2-leaflet";

export default {
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LTooltip,
    LIcon,
  },

  data() {
    return {
      zoom: 13,
      center: latLng(47.41322, -1.219482),
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      withPopup: latLng(47.41322, -1.219482),
      withTooltip: latLng(47.41422, -1.250482),
      currentZoom: 11.5,
      currentCenter: latLng(47.41322, -1.219482),
      showParagraph: false,
      mapOptions: {
        zoomSnap: 0.5,
      },
      showMap: true,
    };
  },

  computed: {
    establecimientos() {
      return this.$store.getters.obtenerEstablecimientos;
    },
  },

  created() {
    axios.get("/api/establecimientos").then((respuesta) => {
      this.$store.dispatch("agregarEstablecimientos", respuesta.data);
    });
  },
};
</script>

<style scoped>
.mapa {
  height: 600px;
  width: 100%;
}
</style>