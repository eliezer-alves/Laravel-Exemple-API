require("./bootstrap");

import "tailwindcss/tailwind.css";

import Vue from "vue";

import Vuex from "vuex";
Vue.use(Vuex);

import LottieAnimation from "lottie-vuejs/src/LottieAnimation.vue"; // import lottie-vuejs
Vue.use(LottieAnimation); // add lottie-animation to your global scope


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
Vue.use(money, { precision: 4 })

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

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
