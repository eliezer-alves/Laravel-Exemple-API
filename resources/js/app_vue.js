require("./bootstrap");

import "tailwindcss/tailwind.css";

import Vue from "vue";

import Vuex from "vuex";
Vue.use(Vuex);

import VueRouter from "vue-router";
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: require("./routes.js"),
});

import actions from './vuex/actions'
import mutations from './vuex/mutations'
import getters from './vuex/getters'
import state from "./vuex/state";

const store = new Vuex.Store({
    // strict: false,
    state,
    getters,
    mutations,
    actions
});

import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

import money from 'v-money'

// register directive v-money and component <money>
Vue.use(money, { precision: 4 })


const app = new Vue({
    router,
    store,
    el: "#app",
    components: {
    },
    created() {
        console.log("Startin Vue");
    },
    data: {
    }
});
