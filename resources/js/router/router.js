import Vue from "vue";
import VueRouter from "vue-router";

// components
import InicioEstablecimientos from "../components/InicioEstablecimientos.vue";
import MostrarEstablecimiento from "../components/MostrarEstablecimiento.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/", component: InicioEstablecimientos },
        {
            path: "/establecimiento/:id",
            name: "establecimiento",
            component: MostrarEstablecimiento
        }
    ]
});

Vue.use(VueRouter);

export default router;
