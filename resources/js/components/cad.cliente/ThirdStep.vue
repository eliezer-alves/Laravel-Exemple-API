<template>
  <cadastro-cliente :validation="validation">
    <div class="py-1">
      <span class="px-1 text-sm text-gray-200">CEP</span>
      <input
        id="cep"
        name="cep"
        placeholder="37750-000"
        type="text"
        class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
        v-model="cliente.cep"
        v-mask="'#####-###'"
        @blur="setCepCliente($event.target.value)"
      />
      <span
        class="px-1 text-sm font-semibold text-red-600"
        v-for="cep in errors.cep"
        :key="cep"
        >{{ cep }}</span
      >
      <div class="text-red-600" v-if="$v.cep.$dirty && !$v.cep.required">
        CEP Inválido
      </div>
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
        class="px-1 text-sm font-semibold text-red-600"
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
        class="px-1 text-sm font-semibold text-red-600"
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
        class="px-1 text-sm font-semibold text-red-600"
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
        v-model.number="cliente.id_tipo_logradouro"
      >
        <option value="0">Avenida</option>
        <option value="1">Praça</option>
        <option value="2">Rua</option>
      </select>
      <span
        class="px-1 text-sm font-semibold text-red-600"
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
          class="px-1 text-sm font-semibold text-red-600"
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
          class="px-1 text-sm font-semibold text-red-600"
          v-for="numero in errors.numero"
          :key="numero"
          >{{ numero }}</span
        >
      </div>
    </div>
    <div class="py-1 flex">
      <div class="flex-col w-full mr-1">
        <span class="px-1 text-sm text-gray-200">Complemento</span>
        <input
          id="complemento"
          name="complemento"
          type="text"
          class="text-md block px-3 py-1 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-400 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
          v-model="cliente.complemento"
        />
        <span
          class="px-1 text-sm font-semibold text-red-600"
          v-for="complemento in errors.complemento"
          :key="complemento"
          >{{ complemento }}</span
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
import { mapFields } from "vuex-map-fields";
import { required } from "vuelidate/lib/validators";

export default {
  components: {
    CadastroCliente
  },
  data() {
    return {
      cep: "",
      uf: "",
      bairro: "",
      cidade: "",
      logradouro: "",
      complemento: ""
    };
  },
  beforeCreate: function() {
    document.body.className = "login";
  },
  computed: {
    ...mapGetters(["cliente", "errors"]),
    ...mapFields(["cliente", "errors"]),
    validation: function() {
      if (!this.cliente.cep) return false;
      if (!this.cliente.uf) return false;
      if (!this.cliente.cidade) return false;
      if (!this.cliente.bairro) return false;
      if (!this.cliente.id_tipo_logradouro) return false;
      if (!this.cliente.logradouro) return false;
      if (!this.cliente.numero) return false;
      return true;
    }
  },
  validations: {
    cep: {
      required
    },
    uf: {},
    bairro: {},
    cidade: {},
    logradouro: {},
    complemento: {}
  },
  methods: {
    async cadastrarCliente() {
      const response = await this.$store.dispatch("createCliente", {
        ...this.cliente
      });
      console.log(response);
      if (!response) this.$router.push("cadastro-cliente");
      else {
        this.cliente = {};
        this.errors = [];
        this.$router.push("login");
      }
    },
    setLogradouro(value) {
      this.cliente.logradouro = value;
    },
    setBairro(value) {
      this.cliente.bairro = value;
    },
    setCidade(value) {
      this.cliente.cidade = value;
    },
    setUf(value) {
      this.cliente.uf = value;
    },
    setComplemento(value) {
      this.cliente.complemento = value;
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

        this.cep = null;
        this.$v.cep.$touch();
      } else {
        this.setBairro(dadosEndereco.bairro);
        if (dadosEndereco.bairro != "") {
          document.querySelector("#bairro").disabled = true;
          document.querySelector("#bairro").value = dadosEndereco.bairro;
        }

        this.setCidade(dadosEndereco.localidade);
        if (dadosEndereco.localidade != "") {
          document.querySelector("#cidade").disabled = true;
        }

        this.setLogradouro(dadosEndereco.logradouro);
        if (dadosEndereco.logradouro != "") {
          document.querySelector("#logradouro").disabled = true;
        }

        this.setUf(dadosEndereco.uf);
        if (dadosEndereco.uf != "") {
          document.querySelector("#uf").disabled = true;
        }
        console.log(dadosEndereco);

        this.setComplemento(dadosEndereco.complemento);

        this.cep = value;
        this.$v.cep.$touch();
      }
    }
  }
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
