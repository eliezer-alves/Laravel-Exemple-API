<template>
    <cadastro-cliente>
      <div class="py-1">
        <span class="px-1 text-sm font-bold text-white">CEP</span>
        <input
          id="cep"
          name="cep"
          placeholder="37750-000"
          type="text"
          class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
          v-mask="'#####-###'"
          :value="$v.cliente.cep.$model"
          @blur="setCepCliente($event.target.value)"
        />
        <div
          class="text-red-600"
          v-if="$v.cliente.cep.$dirty && !$v.cliente.cep.required"
        >
          CEP Inválido.
        </div>
      </div>
      <div class="py-1">
        <span class="px-1 text-sm font-bold text-white">UF</span>
        <select
          id="uf"
          name="uf"
          class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
          v-model="$v.cliente.uf.$model"
        >
          <option value="">--</option>
          <option v-for="uf in dominios.uf" :key="uf.codigo" :value="uf.codigo">
            {{ uf.descricao }}
          </option>
        </select>
        <div
          class="text-red-600"
          v-if="$v.cliente.uf.$dirty && !$v.cliente.uf.required"
        >
          UF Inválida.
        </div>
      </div>
      <div class="py-1">
        <span class="px-1 text-sm font-bold text-white">Cidade</span>
        <input
          id="cidade"
          name="cidade"
          type="text"
          class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
          v-model="$v.cliente.cidade.$model"
        />
        <div
          class="text-red-600"
          v-if="$v.cliente.cidade.$dirty && !$v.cliente.cidade.required"
        >
          Cidade Inválida.
        </div>
      </div>
      <div class="py-1">
        <span class="px-1 text-sm font-bold text-white">Bairro</span>
        <input
          id="bairro"
          name="bairro"
          type="text"
          class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
          v-model="$v.cliente.bairro.$model"
        />
        <div
          class="text-red-600"
          v-if="$v.cliente.bairro.$dirty && !$v.cliente.bairro.required"
        >
          Bairro Inválido.
        </div>
      </div>
      <div class="py-1">
        <span class="px-1 text-sm font-bold text-white"
          >Tipo de Logradouro</span
        >
        <select
          id="id_tipo_logradouro"
          name="id_tipo_logradouro"
          class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
          v-model="$v.cliente.id_tipo_logradouro.$model"
        >
          <option value="">--</option>
          <option
            v-for="tipo_logradouro in dominios.tipoLogradouro"
            :key="tipo_logradouro.id_tipo_logradouro"
            :value="tipo_logradouro.id_tipo_logradouro"
          >
            {{ tipo_logradouro.descricao }}
          </option>
        </select>
        <div
          class="text-red-600"
          v-if="
            $v.cliente.id_tipo_logradouro.$dirty &&
            !$v.cliente.id_tipo_logradouro.required
          "
        >
          Tipo de Logradouro Inválido.
        </div>
      </div>
      <div class="py-1 flex">
        <div class="flex-col w-full mr-1">
          <span class="px-1 text-sm font-bold text-white">Logradouro</span>
          <input
            id="logradouro"
            name="logradouro"
            type="text"
            class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            v-model.trim="$v.cliente.logradouro.$model"
          />
          <div
            class="text-red-600"
            v-if="
              $v.cliente.logradouro.$dirty && !$v.cliente.logradouro.required
            "
          >
            Logradouro Inválido.
          </div>
          <span
            class="px-1 text-sm font-semibold text-red-600"
            v-for="logradouro in errors.logradouro"
            :key="logradouro"
            >{{ logradouro }}</span
          >
        </div>
        <div class="flex-col">
          <span class="px-1 text-sm font-bold text-white">Número</span>
          <input
            id="numero"
            name="numero"
            type="number"
            class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            v-model="$v.cliente.numero.$model"
          />
          <div
            class="text-red-600"
            v-if="$v.cliente.numero.$dirty && !$v.cliente.numero.required"
          >
            Número Inválido.
          </div>
          <span
            class="px-1 text-sm font-semibold text-red-600"
            v-for="numero in errors.numero"
            :key="numero"
            >{{ numero }}</span
          >
        </div>
      </div>
      <div class="py-1 flex">
        <div class="flex-col w-full mr-1">
          <span class="px-1 text-sm font-bold text-white">Complemento</span>
          <input
            id="complemento"
            name="complemento"
            type="text"
            class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
            v-model="$v.cliente.complemento.$model"
          />
          <span
            class="px-1 text-sm font-semibold text-red-600"
            v-for="complemento in errors.complemento"
            :key="complemento"
            >{{ complemento }}</span
          >
        </div>
      </div>
      <div class="flex justify-between">
        <router-link :to="{ name: 'cadastro-cliente-2' }">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="font-bold text-white hover:text-teal-600 w-12"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M7 16l-4-4m0 0l4-4m-4 4h18"
            />
          </svg>
        </router-link>
      </div>
      <button
        @click.prevent="validateFields"
        class="my-2 w-full text-center text-white text-lg font-bold bg-teal-600 hover:bg-teal-800 p-3 rounded-md"
      >
        Cadastrar
      </button>
    </cadastro-cliente>
</template>
<script>
import CadastroCliente from "../CadastroCliente.vue";
import { mapGetters } from "vuex";
import { mapFields } from "vuex-map-fields";
import { required } from "vuelidate/lib/validators";

export default {
  components: {
    CadastroCliente,
  },
  beforeCreate: function () {
    document.body.className = "login";
  },
  async mounted() {
    await this.$store.dispatch("fetchDominios");
  },
  data() {
    return {};
  },
  computed: {
    ...mapGetters(["cliente", "errors", "dominios"]),
    ...mapFields(["cliente", "errors"]),
  },
  validations: {
    cliente: {
      cep: { required },
      uf: { required },
      bairro: { required },
      cidade: { required },
      id_tipo_logradouro: { required },
      logradouro: { required },
      numero: { required },
      complemento: {},
    },
  },
  methods: {
    async cadastrarCliente() {
      const response = await this.$store.dispatch("createCliente", {
        ...this.cliente,
      });

      if (!response) {
        this.$store.commit("SHOW_MODAL", true);
      } else {
        this.$router.push({ name: "login", params: { successPopUp: true } });
      }
    },
    validateFields() {
      if (!this.$v.$invalid) {
        this.cadastrarCliente();
      }
      this.$v.$touch();
    },
    async setCepCliente(value) {
      value = value.replace(/[^\d]+/g, "");
      let dadosEndereco = await this.$store.dispatch("getViaCep", value);

      if (dadosEndereco.erro) {
        this.setBairro("");
        document.querySelector("#bairro").disabled = false;

        this.setCidade("");
        document.querySelector("#cidade").disabled = false;

        this.setLogradouro("");
        document.querySelector("#logradouro").disabled = false;

        this.setUf("");
        document.querySelector("#uf").disabled = false;

        this.setComplemento("");
        document.querySelector("#complemento").value = "";

        this.$v.cliente.cep.$model = null;
        this.$v.cliente.cep.$touch();
      } else {
        this.setBairro(dadosEndereco.bairro);
        /* if (dadosEndereco.bairro != "") {
          document.querySelector("#bairro").disabled = true;
          document.querySelector("#bairro").value = dadosEndereco.bairro;
        } */

        this.setCidade(dadosEndereco.localidade);
        if (dadosEndereco.localidade != "") {
          document.querySelector("#cidade").disabled = true;
        }

        this.setLogradouro(dadosEndereco.logradouro);
        /* if (dadosEndereco.logradouro != "") {
          document.querySelector("#logradouro").disabled = true;
        } */

        this.setUf(dadosEndereco.uf);
        if (dadosEndereco.uf != "") {
          document.querySelector("#uf").disabled = true;
        }
        // console.log(dadosEndereco);

        this.setComplemento(dadosEndereco.complemento);

        this.$v.cliente.cep.$model = value;
        this.$v.cliente.cep.$touch();
      }
    },
    setLogradouro(value) {
      this.$v.cliente.logradouro.$model = value;
    },
    setBairro(value) {
      this.$v.cliente.bairro.$model = value;
    },
    setCidade(value) {
      this.$v.cliente.cidade.$model = value;
    },
    setUf(value) {
      this.$v.cliente.uf.$model = value;
    },
    setComplemento(value) {
      this.$v.cliente.complemento.$model = value;
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
