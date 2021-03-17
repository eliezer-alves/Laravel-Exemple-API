<template>
  <transition name="fade">
    <cadastro-cliente>
      <div class="py-1">
        <span class="px-1 text-sm font-bold text-white">CNPJ</span>
        <input
          id="cnpj"
          name="cnpj"
          placeholder="##.###.###/####-##"
          type="text"
          class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
          :value="$v.cliente.cnpj.$model"
          @input="setCnpj($event.target.value)"
          v-mask="'##.###.###/####-##'"
        />
        <div
          class="text-red-600"
          v-if="$v.cliente.cnpj.$dirty && !$v.cliente.cnpj.required"
        >
          CNPJ é obrigatório.
        </div>
        <div
          class="text-red-600"
          v-if="$v.cliente.cnpj.$dirty && !$v.cliente.cnpj.valid"
        >
          CNPJ inválido.
        </div>
      </div>
      <div class="py-1">
        <span class="px-1 text-sm font-bold text-white">Insc. Estadual</span>
        <input
          id="inscricao_estadual"
          name="inscricao_estadual"
          placeholder="##.###.####-#"
          type="text"
          class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
          v-mask="'##.###.####-#'"
          :value="$v.cliente.inscricao_estadual.$model"
          @input="setInscricaoEstadual($event.target.value)"
        />
        <div
          class="text-red-600"
          v-if="
            $v.cliente.inscricao_estadual.$dirty &&
            !$v.cliente.inscricao_estadual.required
          "
        >
          Inscrição Estadual é obrigatório.
        </div>
      </div>
      <div class="py-1">
        <span class="px-1 text-sm font-bold text-white"
          >Atividade Comercial</span
        >
        <select
          id="id_atividade_comercial"
          name="id_atividade_comercial"
          class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
          v-model="$v.cliente.id_atividade_comercial.$model"
        >
          <option value="">--</option>
          <option
            v-for="atividade in atividades"
            :key="atividade.id_atividade_comercial"
            :value="atividade.id_atividade_comercial"
          >
            {{ atividade.descricao }}
          </option>
        </select>
        <div
          class="text-red-600"
          v-if="
            $v.cliente.id_atividade_comercial.$dirty &&
            !$v.cliente.id_atividade_comercial.required
          "
        >
          Atividade Comercial é obrigatório.
        </div>
      </div>
      <div class="py-1">
        <span class="px-1 text-sm font-bold text-white">Nome Fantasia</span>
        <input
          id="nome_fantasia"
          name="nome_fantasia"
          type="text"
          class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
          v-model.trim="$v.cliente.nome_fantasia.$model"
        />
        <div
          class="text-red-600"
          v-if="
            $v.cliente.nome_fantasia.$dirty &&
            !$v.cliente.nome_fantasia.required
          "
        >
          Nome Fantasia é obrigatório.
        </div>
      </div>
      <div class="py-1">
        <span class="px-1 text-sm font-bold text-white">Razão Social</span>
        <input
          id="razao_social"
          name="razao_social"
          type="text"
          class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
          v-model.trim="$v.cliente.razao_social.$model"
        />
        <div
          class="text-red-600"
          v-if="
            $v.cliente.razao_social.$dirty && !$v.cliente.razao_social.required
          "
        >
          Razão Social é obrigatório.
        </div>
      </div>
      <div class="flex justify-end">
        <svg
          @click="validateFields"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          class="text-gray-200 hover:text-teal-600 w-12 cursor-pointer"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M17 8l4 4m0 0l-4 4m4-4H3"
          />
        </svg>
      </div>
    </cadastro-cliente>
  </transition>
</template>
<script>
import { mapGetters } from "vuex";
import { mapFields } from "vuex-map-fields";
import { validarCNPJ } from "../../helper";
import { required, minValue, minLength, email } from "vuelidate/lib/validators";

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
    ...mapFields(["cliente", "errors"]),
  },
  validations: {
    cliente: {
      cnpj: { required },
      inscricao_estadual: { required },
      id_atividade_comercial: { required },
      nome_fantasia: { required },
      razao_social: { required },
    },
  },
  methods: {
    setCnpj(value) {
      value = value.replace(/[^\d]+/g, "");
      this.$v.cliente.cnpj.valid = validarCNPJ(value);
      this.cliente.cnpj = value;
      this.$v.cliente.cnpj.$touch();
    },
    setInscricaoEstadual(value) {
      value = value.replace(/[^\d]+/g, "");
      this.cliente.inscricao_estadual = value;
      this.$v.cliente.inscricao_estadual.$touch();
    },
    validateFields() {
      if (!this.$v.$invalid) {
        this.$router.push("cadastro-cliente-2");
      }
      this.$v.$touch();
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
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, 
.fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
