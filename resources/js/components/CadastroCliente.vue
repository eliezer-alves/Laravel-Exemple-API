<template>
  <!-- component -->
  <div
    class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 px-2 py-5 xl:w-7/12 lg:w-7/12 md:w-7/12 w-11/12 mx-auto mt-20"
  >
    <div
      class="lg:mt-32 md:mt-32 sm:mt-10 mt-10 lg:ml-32 md:ml-32 mx-auto my-2 col-span-1"
    >
      <router-link :to="{ name: 'login' }">
        <img src="/images/logoAgilVertical.png" class="w-72" alt="" />
        <h1
          class="mt-4 lg:text-3xl md:text-lg text-center text-3xl text-gradient bg-gradient-to-r from-gray-300 via-white to-gray-300 hover:bg-gradient-to-l hover:from-yellow-400 hover:to-teal-600"
        >
          Capital de Giro
        </h1>
      </router-link>
    </div>

    <div
      class="xl:w-7/12 lg:w-7/12 md:w-7/12 w-9/12 mx-auto lg:mt-12 md:mt-12 sm:mt-12 m2-2 lg:col-span-2 md:col-span-2 px-5 bg-white bg-opacity-40 shadow-md rounded-md pt-1 pb-3"
    >
      <h1
        class="mt-4 text-center lg:text-3xl text-2xl text-gradient bg-gradient-to-r from-white to-white hover:bg-gradient-to-l hover:from-yellow-300 hover:to-teal-600"
      >
        Formulário de Cadastro
      </h1>
      <form @submit="cadastrarCliente()" class="w-full">
        <div class="grid">
          <slot></slot>
        </div>
      </form>
    </div>
    <Modal v-show="showModal" />
  </div>
</template>
<script>
import Modal from "./cad.cliente/Modal.vue";

export default {
  components: { Modal },
  data: function () {
    return {};
  },
  props: ["validation"],
  beforeCreate: function () {
    document.body.className = "login";
  },
  async mounted() {},
  computed: {
    currentRoute: function () {
      return this.$router.currentRoute.name;
    },
    showModal: function () {
      return this.$store.state.showModal;
    },
  },
  methods: {
    goBack: function () {
      return this.currentRoute === "cadastro-cliente-3"
        ? { name: "cadastro-cliente-2" }
        : { name: "cadastro-cliente" };
    },
    goFoward: function () {
      return this.currentRoute === "cadastro-cliente"
        ? { name: "cadastro-cliente-2" }
        : { name: "cadastro-cliente-3" };
    },
  },
};
</script>
<style>
.login {
  -webkit-font-smoothing: antialiased;
  background-image: url("/images/texturaBackgroundAgil.png");
  background-color: #30615f;
  background-size: 900px;
}
</style>
