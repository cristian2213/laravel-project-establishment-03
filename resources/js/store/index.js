import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
const store = new Vuex.Store({
    state: {
        cafes: [],
        restaurantes: [],
        hoteles: []
    },
    mutations: {
        agregarCafes(state, payload) {
            state.cafes = payload;
        },

        agregarRestaurantes(state, payload) {
            state.restaurantes = payload;
        },

        agregarHoteles(state, payload) {
            state.hoteles = payload;
        }
    },

    actions: {
        agregarCafes(context, payload) {
            context.commit("agregarCafes", payload);
        },

        agregarRestaurantes(context, payload) {
            context.commit("agregarRestaurantes", payload);
        },

        agregarHoteles(context, payload) {
            context.commit("agregarHoteles", payload);
        }
    },

    getters: {
        obtenerCafes(state) {
            return state.cafes;
        },

        obtenerRestaurantes(state) {
            return state.restaurantes;
        },

        obtenerHoteles(state) {
            return state.hoteles;
        }
    }
});

export default store;
