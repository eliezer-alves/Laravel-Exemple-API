<template>
  <cadastro-cliente :validation="validation">
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">Celular</span>
      <input
        id="celular"
        name="celular"
        placeholder="(00) 00000-0000"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.celular"
      />
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="celular in errors.celular"
        :key="celular"
        >{{ celular }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">E-mail</span>
      <input
        id="email"
        name="email"
        placeholder="mail@mail.com"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.email"
      />
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="email in errors.email"
        :key="email"
        >{{ email }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">Confirmar E-mail</span>
      <input
        id="email_confirmation"
        name="email_confirmation"
        placeholder="mail@mail.com"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.email_confirmation"
      />
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="email_confirmation in errors.email_confirmation"
        :key="email_confirmation"
        >{{ email_confirmation }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">Senha</span>
      <input
        id="senha"
        name="senha"
        type="password"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.senha"
      />
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="senha in errors.senha"
        :key="senha"
        >{{ senha }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">Confirmar Senha</span>
      <input
        id="senha_confirmation"
        name="senha_confirmation"
        type="password"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.senha_confirmation"
      />
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="senha_confirmation in errors.senha_confirmation"
        :key="senha_confirmation"
        >{{ senha_confirmation }}</span
      >
    </div>
  </cadastro-cliente>
</template>
<script>
import CadastroCliente from "../CadastroCliente.vue";
import { mapGetters } from "vuex";

export default {
  components: {
    CadastroCliente,
  },
  computed: {
    ...mapGetters(["cliente", "errors"]),
    validation: function () {
      if (!this.cliente.celular) return false;
      if (!this.cliente.email) return false;
      if (!this.cliente.email_confirmation) return false;
      if (!this.cliente.senha) return false;
      if (!this.cliente.senha_confirmation) return false;
      return true;
    },
  },
  filters: {},
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
