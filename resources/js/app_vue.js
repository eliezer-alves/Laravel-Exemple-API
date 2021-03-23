require("./bootstrap");
import "tailwindcss/tailwind.css";
import "animate.css"
import Vue from "vue";


//VUE ROUTER
import VueRouter from "vue-router";
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: require("./routes.js"),
});

router.beforeEach((to, from, next) => {
    // redirect to login page if not logged in and trying to access a restricted page
    const publicPages = ['/app/login', '/app/cadastro-cliente', '/app/cadastro-cliente-2', '/app/cadastro-cliente-3'];
    const authRequired = !publicPages.includes(to.path);
    const accessToken = localStorage.getItem('access_token');
    if (authRequired && !accessToken) {
        return next('/app/login');
    }

    next();
})

//VUEX
import Vuex from "vuex";
Vue.use(Vuex);

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

//VUE THE MASK
import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

import money from 'v-money'
Vue.use(money, { precision: 4 })

//VUELIDATE
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

//SWEET ALERT 2
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css'; // If you don't need the styles, do not connect
Vue.use(VueSweetalert2);

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
