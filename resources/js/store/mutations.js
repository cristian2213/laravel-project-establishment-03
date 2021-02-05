export default {
    agregarCafes(state, payload) {
        state.cafes = payload;
    },

    agregarRestaurantes(state, payload) {
        state.restaurantes = payload;
    },

    agregarHoteles(state, payload) {
        state.hoteles = payload;
    },

    agregarEstablecimiento(state, payload) {
        state.establecimiento = payload;
    }
};
