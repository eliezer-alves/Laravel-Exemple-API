require("./bootstrap");
import "tailwindcss/tailwind.css";

import Vue from "vue";

import Vuex from "vuex";
Vue.use(Vuex);

import VueRouter from "vue-router";
Vue.use(VueRouter);

const router = new VueRouter({
    // mode: 'history',
    routes: require("./routes.js"),
});

const store = new Vuex.Store({});

const app = new Vue({
    router,
    store,
    el: "#app",
    created() {
        console.log("Startin Vue");
    },
});
