<template>
  <cadastro-cliente>
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">CEP</span>
      <input
        id="cep"
        name="cep"
        placeholder="37750-000"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.cep"
      />
      <span
        class="px-1 text-xs text-red-600"
        v-for="cep in errors.cep"
        :key="cep"
        >{{ cep }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">UF</span>
      <select
        id="uf"
        name="uf"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.uf"
      >
        <option :value="'MG'">Minas Gerais</option>
        <option :value="'RJ'">Rio de Janeiro</option>
        <option :value="'SP'">São Paulo</option>
      </select>
      <span
        class="px-1 text-xs text-red-600"
        v-for="uf in errors.uf"
        :key="uf"
        >{{ uf }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">Cidade</span>
      <input
        id="cidade"
        name="cidade"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.cidade"
      />
      <span
        class="px-1 text-xs text-red-600"
        v-for="cidade in errors.cidade"
        :key="cidade"
        >{{ cidade }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">Bairro</span>
      <input
        id="bairro"
        name="bairro"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.bairro"
      />
      <span
        class="px-1 text-xs text-red-600"
        v-for="bairro in errors.bairro"
        :key="bairro"
        >{{ bairro }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">Tipo de Logradouro</span>
      <select
        id="id_tipo_logradouro"
        name="id_tipo_logradouro"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.id_tipo_logradouro"
      >
        <option value="avenida">Avenida</option>
        <option value="praca">Praça</option>
        <option value="rua">Rua</option>
      </select>
      <span
        class="px-1 text-xs text-red-600"
        v-for="id_tipo_logradouro in errors.id_tipo_logradouro"
        :key="id_tipo_logradouro"
        >{{ id_tipo_logradouro }}</span
      >
    </div>
    <div class="py-1 flex">
      <div class="flex-col w-full mr-1">
        <span class="px-1 text-sm text-gray-200">Logradouro</span>
        <input
          id="logradouro"
          name="logradouro"
          type="text"
          class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
          v-model="cliente.logradouro"
        />
        <span
          class="px-1 text-xs text-red-600"
          v-for="logradouro in errors.logradouro"
          :key="logradouro"
          >{{ logradouro }}</span
        >
      </div>
      <div class="flex-col">
        <span class="px-1 text-sm text-gray-200">Número</span>
        <input
          id="numero"
          name="numero"
          type="number"
          class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
          v-model="cliente.numero"
        />
        <span
          class="px-1 text-xs text-red-600"
          v-for="numero in errors.numero"
          :key="numero"
          >{{ numero }}</span
        >
      </div>
    </div>
    <button
      @click.prevent="cadastrarCliente()"
      class="my-2 w-full text-center text-gray-200 text-lg font-bold bg-green-800 hover:bg-green-900 p-3 rounded-md"
    >
      Cadastrar
    </button>
  </cadastro-cliente>
</template>
<script>
import CadastroCliente from "../CadastroCliente.vue";
import { mapGetters } from "vuex";

export default {
  components: {
    CadastroCliente,
  },
  beforeCreate: function () {
    document.body.className = "login";
  },
  computed: {
    ...mapGetters(["cliente", "errors"]),
  },
  methods: {
    async cadastrarCliente() {
      await this.$store.dispatch("createCliente", this.cliente);
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
