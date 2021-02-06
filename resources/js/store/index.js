import Vue from "vue";
import Vuex from "vuex";

// methods
import storeMutations from "./mutations.js";
import storeActions from "./actions.js";
import storeGetters from "./getters.js";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        cafes: [],
        restaurantes: [],
        hoteles: [],
        establecimiento: {},
        establecimientos: []
    },

    mutations: storeMutations,
    actions: storeActions,
    getters: storeGetters
});

export default store;
