<template>
  <!-- component -->
  <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 px-2 w-11/12 py-1">
    <div
      class="lg:mt-32 md:mt-32 sm:mt-10 mt-10 lg:ml-32 md:ml-32 mx-auto my-2 col-span-1"
    >
      <img src="/images/logoAgilVertical.png" class="w-72" alt="" />
      <h1
        class="mt-4 lg:text-3xl md:text-lg text-center text-3xl text-gradient bg-gradient-to-r from-gray-300 via-white to-gray-300 hover:bg-gradient-to-l hover:from-yellow-300 hover:to-green-600"
      >
        Capital de Giro
      </h1>
    </div>
    <div
      class="w-7/12 mx-auto lg:mt-12 md:mt-12 sm:mt-12 m2-2 lg:col-span-2 md:col-span-2 px-5 bg-white bg-opacity-30 shadow-md rounded-md py-1"
    >
      <h1
        class="mt-4 text-center lg:text-3xl text-2xl text-gradient bg-gradient-to-r from-gray-200 to-gray-200 hover:bg-gradient-to-l hover:from-yellow-300 hover:to-green-500"
      >
        Formulário de Cadastro
      </h1>
      <form @submit="cadastrarCliente()" class="w-full">
        <div class="grid">
          <slot></slot>
        </div>
      </form>
      <div class="flex justify-between">
        <router-link :to="goBack()">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="text-gray-200 hover:text-green-600 w-12"
            v-show="!(currentRoute === 'cadastro-cliente')"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M7 16l-4-4m0 0l4-4m-4 4h18"
            />
          </svg>
        </router-link>
        <router-link :to="goFoward()">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="text-gray-200 hover:text-green-600 w-12"
            v-show="!(currentRoute === 'cadastro-cliente-3') && validation"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M17 8l4 4m0 0l-4 4m4-4H3"
            />
          </svg>
        </router-link>
      </div>
    </div>
  </div>
</template>
<script>
export default {
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
