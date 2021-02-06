export default {
    obtenerCafes(state) {
        return state.cafes;
    },

    obtenerRestaurantes(state) {
        return state.restaurantes;
    },

    obtenerHoteles(state) {
        return state.hoteles;
    },

    obtenerEstablecimiento(state) {
        return state.establecimiento;
    },

    obtenerImagenes(state) {
        return state.establecimiento.imagenes;
    },

    obtenerEstablecimientos(state) {
        return state.establecimientos;
    }
};
