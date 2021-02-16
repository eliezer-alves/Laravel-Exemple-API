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
    state,
    getters,
    mutations,
    actions
});

import Menu from './components/Menu.vue';

const app = new Vue({
    router,
    store,
    el: "#app",
    components: {
        Menu,
    },
    created() {
        console.log("Startin Vue");
    },
    data: {
        bgc: {
            backgroundColor: ''
        }
    }
});
