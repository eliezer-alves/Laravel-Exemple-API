<template>
  <cadastro-cliente :validation="validation">
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">CNPJ</span>
      <input
        id="cnpj"
        name="cnpj"
        placeholder="##.###.###/####-##"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.cnpj"
        v-mask="'##.###.###/####-##'"
      />
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="cnpj in errors.cnpj"
        :key="cnpj"
        >{{ cnpj }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">Insc. Estadual</span>
      <input
        id="inscricao_estadual"
        name="inscricao_estadual"
        placeholder="00.000.0000-0"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.inscricao_estadual"
        v-mask="'##.###.####-#'"
      />
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="inscricao_estadual in errors.inscricao_estadual"
        :key="inscricao_estadual"
        >{{ inscricao_estadual }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">Atividade Comercial</span>
      <select
        id="id_atividade_comercial"
        name="id_atividade_comercial"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model.number="cliente.id_atividade_comercial"
      >
        <option>--</option>
        <option
          v-for="atividade in atividades"
          :key="atividade.id_atividade_comercial"
          :value="atividade.id_atividade_comercial"
        >
          {{ atividade.descricao }}
        </option>
      </select>
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="id_atividade_comercial in errors.id_atividade_comercial"
        :key="id_atividade_comercial"
        >{{ id_atividade_comercial }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">Nome Fantasia</span>
      <input
        id="nome_fantasia"
        name="nome_fantasia"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.nome_fantasia"
      />
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="nome_fantasia in errors.nome_fantasia"
        :key="nome_fantasia"
        >{{ nome_fantasia }}</span
      >
    </div>
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">Razão Social</span>
      <input
        id="razao_social"
        name="razao_social"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.razao_social"
      />
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="razao_social in errors.razao_social"
        :key="razao_social"
        >{{ razao_social }}</span
      >
    </div>
  </cadastro-cliente>
</template>
<script>
import { mapGetters } from "vuex";
import CadastroCliente from "../CadastroCliente.vue";

export default {
  components: {
    CadastroCliente,
  },
  beforeCreate: function () {
    document.body.className = "login";
  },
  async mounted() {
    await this.$store.dispatch("fetchAtividades");
  },
  computed: {
    ...mapGetters(["atividades", "cliente", "errors"]),
    validation: function () {
      if (!this.cliente.cnpj) return false;
      if (!this.cliente.inscricao_estadual) return false;
      if (!this.cliente.id_atividade_comercial) return false;
      if (!this.cliente.nome_fantasia) return false;
      if (!this.cliente.razao_social) return false;
      return true;
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
