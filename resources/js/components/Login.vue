<template>
  <div class="lg:w-4/12 md:6/12 w-10/12 mx-auto mt-36">
    <div class="py-2 rounded-xl">
      <img
        class="mx-auto w-72"
        src="/images/logoAgilVertical.png"
        alt="Workflow"
      />

      <form @submit="login(cliente)" class="mt-2 mx-auto w-72">
        <div class="mt-1 text-sm">
          <input
            type="text"
            autofocus
            id="cnpj"
            class="rounded-sm px-4 py-3 mt-3 w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-green-600 focus:outline-none"
            placeholder="CNPJ"
            v-model="cliente.cnpj"
            v-mask="'##.###.###/####-##'"
          />
        </div>
        <div class="mt-1 text-sm">
          <input
            type="password"
            id="password"
            class="rounded-sm px-4 py-3 mt-3 w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-green-600 focus:outline-none"
            placeholder="Senha"
            v-model="cliente.senha"
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
  props: ["successPopUp"],
  data() {
    return {
      cliente: {
        cnpj: "",
        senha: "",
      },
    };
  },
  beforeCreate: function () {
    document.body.className = "login";
  },
  mounted() {
    this.cadastroSucessoModal();
  },
  computed: {
    ...mapGetters(["errors"]),
  },
  methods: {
    validateFields(cliente) {
      if (!cliente.cnpj) return false;
      if (!cliente.senha) return false;
      return true;
    },
    async login(cliente) {
      if (!this.validateFields(cliente))
        return this.$swal({
          title: "Usuário/Senha vazios.",
          icon: "error",
          showConfirmButton: false,
          timer: 1500,
        });

      const response = await this.$store.dispatch("login", { ...cliente });
      if (response) return this.$router.push("home");
      this.$swal({
        title: "Usuario/Senha inválidos.",
        icon: "error",
        showConfirmButton: false,
        timer: 1500,
      });
    },
    cadastroSucessoModal() {
      if (this.successPopUp)
        this.$swal({
          title: "Cliente cadastrado com sucesso.",
          icon: "success",
          showConfirmButton: false,
          timer: 1500,
        });
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
