<template>
  <div class="lg:w-4/12 md:6/12 w-10/12 mx-auto my-6 ">
    <div class="py-2 rounded-xl">
      <img
        class="mx-auto lg:w-72 w-44"
        src="/images/logoAgilVertical.png"
        alt="Workflow"
      />

      <form @submit="login(cliente)" class="mt-2 mx-auto w-72">
        <div class="flex justify-center">
          <span
            class="px-1 text-sm font-semibold text-yellow-200  w-full text-center"
            v-if="errors.error"
            >{{ errors.error }}</span
          >
        </div>
        <div class="mt-1 text-sm">
          <input
            type="text"
            autofocus
            id="cnpj"
            class="rounded-sm px-4 py-3 mt-3 w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-green-600 focus:outline-none"
            placeholder="CNPJ"
            v-model="cliente.username"
            v-mask="'##.###.###/####-##'"
          />
        </div>
        <div class="mt-1 text-sm">
          <input
            type="password"
            id="password"
            class="rounded-sm px-4 py-3 mt-3 w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-green-600 focus:outline-none"
            placeholder="Senha"
            v-model="cliente.password"
          />
          <router-link to="redefinir-senha">
            <div
              class="flex justify-end text-xs my-3 text-blue-200 hover:underline"
            >
              <p>Esqueceu a senha?</p>
            </div>
          </router-link>
        </div>
        <button
          class="block w-full text-center text-green-900 text-lg font-bold bg-gradient-to-r from-green-600 to-yellow-300 hover:bg-gradient-to-l hover:from-yellow-300 hover:to-green-600 p-3 rounded-md"
          @click.prevent="login(cliente)"
        >
          Entrar
        </button>
        <p class="mt-2 text-center text-md font-light text-white">
          Não tem uma conta?
          <router-link to="cadastro-cliente">
            <a class="font-light text-md text-green-400 hover:text-green-600">
              Criar
            </a>
          </router-link>
        </p>
      </form>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      cliente: {
        username: "",
        password: "",
      },
    };
  },
  beforeCreate: function () {
    document.body.className = "login";
  },
  methods: {
    validateFields(cliente) {
      if (!cliente.username) return false;
      if (!cliente.password) return false;
      return true;
    },
    async login(cliente) {
      if (!this.validateFields(cliente))
        return this.$store.commit("GET_ERRORS", {
          error: "Usuário/Senha vazio",
        });

      const response = await this.$store.dispatch("login", { ...cliente });
      if (response) return this.$router.push("home");
      console.log(this.errors);
    },
  },
  computed: {
    ...mapGetters(["errors"]),
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
