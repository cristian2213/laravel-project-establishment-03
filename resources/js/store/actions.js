export default {
    agregarCafes(context, payload) {
        context.commit("agregarCafes", payload);
    },

    agregarRestaurantes(context, payload) {
        context.commit("agregarRestaurantes", payload);
    },

    agregarHoteles(context, payload) {
        context.commit("agregarHoteles", payload);
    },

    agregarEstablecimiento(context, payload) {
        context.commit("agregarEstablecimiento", payload);
    }
};
