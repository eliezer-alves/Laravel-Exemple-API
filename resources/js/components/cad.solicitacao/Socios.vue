<template>
  <div>
    <div class="grid lg:grid-cols-12 md:grid-cols-12">
      <div
        class="lg:col-span-7 md:col-span-7 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="nome_socio">Nome</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'nome_socio_' + kSocio"
            :name="'nome_socio_' + kSocio"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            placeholder="Nome completo"
            :value="$v.nome_socio.$model"
            @input="setNomeSocio($event.target.value)"
            @blur="setDados"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.nome_socio.$dirty && !$v.nome_socio.required"
        >
          Nome obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-5 md:col-span-5 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="cpf_socio">CPF</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'cpf_socio' + kSocio"
            :name="'cpf_socio' + kSocio"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            placeholder="###.###.###-##"
            v-mask="'###.###.###-##'"
            :value="$v.cpf_socio.$model"
            @input="setCpfSocio($event.target.value)"
            @blur="setDados"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.cpf_socio.$dirty && !$v.cpf_socio.required"
        >
          CPF válido é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="uf_rg_socio">UF do RG</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <select
            :id="'uf_rg_socio' + kSocio"
            :name="'uf_rg_socio' + kSocio"
            class="p-1 px-2 outline-none w-full text-gray-800"
            :value="$v.uf_rg_socio.$model"
            @change="setUfRgSocio($event.target.value)"
            @blur="setDados"
          >
            <option value="">--</option>
            <option
              v-for="uf_rg in dominios.uf"
              :key="uf_rg.codigo"
              :value="uf_rg.codigo"
            >
              {{ uf_rg.descricao }}
            </option>
          </select>
        </div>
        <div
          class="text-red-600"
          v-if="$v.uf_rg_socio.$dirty && !$v.uf_rg_socio.required"
        >
          UF do RG é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="numero_rg_socio">Nº do RG</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'numero_rg_socio' + kSocio"
            :name="'numero_rg_socio' + kSocio"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            :value="$v.numero_rg_socio.$model"
            @input="setNumeroRgSocio($event.target.value)"
            @blur="setDados"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.numero_rg_socio.$dirty && !$v.numero_rg_socio.required"
        >
          RG é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="sexo_socio">Sexo</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <select
            :id="'sexo_socio' + kSocio"
            :name="'sexo_socio' + kSocio"
            class="p-1 px-2 outline-none w-full text-gray-800"
            :value="$v.sexo_socio.$model"
            @change="setSexoSocio($event.target.value)"
            @blur="setDados"
          >
            <option value="">--</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
          </select>
        </div>
        <div
          class="text-red-600"
          v-if="$v.sexo_socio.$dirty && !$v.sexo_socio.required"
        >
          Sexo é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="estado_civil_socio">Estado Cívil</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <select
            :id="'estado_civil_socio' + kSocio"
            :name="'estado_civil_socio' + kSocio"
            class="p-1 px-2 outline-none w-full text-gray-800"
            :value="$v.estado_civil_socio.$model"
            @change="setEstadoCivilSocio($event.target.value)"
            @blur="setDados"
          >
            <option value="">--</option>
            <option
              v-for="estado_civil in dominios.estadoCivil"
              :key="estado_civil.codigo"
              :value="estado_civil.codigo"
            >
              {{ estado_civil.descricao }}
            </option>
          </select>
        </div>
        <div
          class="text-red-600"
          v-if="$v.estado_civil_socio.$dirty && !$v.estado_civil_socio.required"
        >
          Estado Civil é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="email_socio">E-mail</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'email_socio' + kSocio"
            :name="'email_socio' + kSocio"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            placeholder="mail@brasilcard.net"
            :value="$v.email_socio.$model"
            @input="setEmailSocio($event.target.value)"
            @blur="setDados"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.email_socio.$dirty && !$v.email_socio.required"
        >
          E-mail é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="telefone_socio">Telefone</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'telefone_socio' + kSocio"
            :name="'telefone_socio' + kSocio"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            v-mask="['(##) ####-####', '(##) #####-####']"
            :value="$v.telefone_socio.$model"
            @input="setTelefoneSocio($event.target.value)"
            @blur="setDados"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.telefone_socio.$dirty && !$v.telefone_socio.required"
        >
          Telefone é obrigatório.
        </div>
      </div>
    </div>
    <div
      class="grid lg:grid-cols-12 md:grid-cols-12 border-t-2 border-b-2 border-teal-600 mt-5"
    >
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="cep_socio">CEP</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'cep_socio' + kSocio"
            :name="'cep_socio' + kSocio"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            placeholder="#####-###"
            v-mask="'#####-###'"
            :value="$v.cep_socio.$model"
            @change="setCepSocio($event.target.value)"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.cep_socio.$dirty && !$v.cep_socio.required"
        >
          CEP é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="uf_socio">UF</label>
        </div>
        <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
          <select
            :id="'uf_socio' + kSocio"
            :name="'uf_socio' + kSocio"
            class="p-1 px-2 outline-none w-full text-gray-800"
            disabled
            :value="$v.uf_socio.$model"
            @change="setUfSocio($event.target.value)"
            @blur="setDados"
          >
            <option value="">--</option>
            <option
              v-for="uf in dominios.uf"
              :key="uf.codigo"
              :value="uf.codigo"
            >
              {{ uf.descricao }}
            </option>
          </select>
        </div>
        <div
          class="text-red-600"
          v-if="$v.uf_socio.$dirty && !$v.uf_socio.required"
        >
          UF é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="cidade_socio">Cidade</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'cidade_socio' + kSocio"
            :name="'cidade_socio' + kSocio"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            placeholder="Cidade"
            disabled
            :value="$v.cidade_socio.$model"
            @input="setCidadeSocio($event.target.value)"
            @blur="setDados"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.cidade_socio.$dirty && !$v.cidade_socio.required"
        >
          Cidade é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="bairro_socio">Bairro</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'bairro_socio' + kSocio"
            :name="'bairro_socio' + kSocio"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            placeholder="Bairro"
            :value="$v.bairro_socio.$model"
            @input="setBairroSocio($event.target.value)"
            @blur="setDados"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.bairro_socio.$dirty && !$v.bairro_socio.required"
        >
          Bairro é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="tipo_logradouro_socio">Tipo de Logradouro</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <select
            :id="'tipo_logradouro_socio' + kSocio"
            :name="'tipo_logradouro_socio' + kSocio"
            class="p-1 px-2 outline-none w-full text-gray-800"
            :value="$v.tipo_logradouro_socio.$model"
            @change="setTipoLogradouroSocio($event.target.value)"
            @blur="setDados"
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
        </div>
        <div
          class="text-red-600"
          v-if="
            $v.tipo_logradouro_socio.$dirty &&
            !$v.tipo_logradouro_socio.required
          "
        >
          Tipo de Logradouro é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="logradouro_socio">Logradouro</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'logradouro_socio' + kSocio"
            :name="'logradouro_socio' + kSocio"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
            :value="$v.logradouro_socio.$model"
            @input="setLogradouroSocio($event.target.value)"
            @blur="setDados"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.logradouro_socio.$dirty && !$v.logradouro_socio.required"
        >
          Logradouro é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="numero_socio">Número</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'numero_socio' + kSocio"
            :name="'numero_socio' + kSocio"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="number"
            :value="$v.numero_socio.$model"
            @input="setNumeroSocio($event.target.value)"
            @blur="setDados"
          />
        </div>
        <div
          class="text-red-600"
          v-if="$v.numero_socio.$dirty && !$v.numero_socio.required"
        >
          Número é obrigatório.
        </div>
      </div>
      <div
        class="lg:col-span-9 md:col-span-9 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
      >
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          <label for="complemento_socio">Complemento</label>
        </div>
        <div class="bg-white my-2 p-1 border border-gray-200 rounded">
          <input
            :id="'complemento_socio' + kSocio"
            :name="'complemento_socio' + kSocio"
            class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
            type="text"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { required, minValue, minLength, email } from "vuelidate/lib/validators";
import { validaCPF } from "../../helper.js";

export default {
  props: ["kSocio"],
  computed: {
    ...mapGetters(["dominios", "solicitacao", "errors"]),
  },
  data() {
    return {
      nome_socio: null,
      cpf_socio: null,
      uf_rg_socio: null,
      numero_rg_socio: null,
      sexo_socio: null,
      estado_civil_socio: null,
      email_socio: null,
      telefone_socio: null,
      cep_socio: null,
      uf_socio: null,
      cidade_socio: null,
      bairro_socio: null,
      tipo_logradouro_socio: null,
      logradouro_socio: null,
      numero_socio: null,
      complemento_socio: null,
    };
  },
  async mounted() {
    this.$store.commit("GET_ERRORS", {
      invalid: this.$v.$invalid,
    });
    await this.$store.dispatch("fetchDominios");
  },
  validations: {
    nome_socio: {
      required,
    },
    cpf_socio: {
      required,
    },
    uf_rg_socio: {
      required,
    },
    numero_rg_socio: {
      required,
    },
    sexo_socio: {
      required,
    },
    estado_civil_socio: {
      required,
    },
    email_socio: {
      required,
    },
    telefone_socio: {
      required,
    },
    cep_socio: {
      required,
    },
    uf_socio: {
      required,
    },
    cidade_socio: {
      required,
    },
    bairro_socio: {
      required,
    },
    tipo_logradouro_socio: {
      required,
    },
    logradouro_socio: {
      required,
    },
    complemento_socio: {},
    numero_socio: {
      required,
    },
  },
  methods: {
    setNomeSocio(value) {
      this.nome_socio = value;
      this.$v.nome_socio.$touch();
    },
    setCpfSocio(value) {
      value = value.replace(/[^\d]+/g, "");
      let isInvalid = validaCPF(value);
      if (isInvalid) {
        this.cpf_socio = null;
      } else this.cpf_socio = value;

      this.$v.cpf_socio.$touch();
    },
    setUfRgSocio(value) {
      this.uf_rg_socio = value;
      this.$v.uf_rg_socio.$touch();
    },
    setNumeroRgSocio(value) {
      this.numero_rg_socio = value;
      this.$v.numero_rg_socio.$touch();
    },
    setSexoSocio(value) {
      this.sexo_socio = value;
      this.$v.sexo_socio.$touch();
    },
    setEstadoCivilSocio(value) {
      this.estado_civil_socio = value;
      this.$v.estado_civil_socio.$touch();
    },
    setEmailSocio(value) {
      this.email_socio = value;
      this.$v.email_socio.$touch();
    },
    setTelefoneSocio(value) {
      value = value.replace(/[^\d]+/g, "");
      this.telefone_socio = value;
      this.$v.telefone_socio.$touch();
    },
    async setCepSocio(value) {
      value = value.replace(/[^\d]+/g, "");
      let dadosEndereco = await this.$store.dispatch("getViaCep", value);
      if (dadosEndereco.erro) {
        this.setBairroSocio("");
        document.querySelector(`#bairro_socio${this.kSocio}`).disabled = false;

        this.setCidadeSocio("");
        document.querySelector(`#cidade_socio${this.kSocio}`).disabled = false;

        this.setLogradouroSocio("");
        document.querySelector(
          `#logradouro_socio${this.kSocio}`
        ).disabled = false;

        this.setUfSocio("");
        document.querySelector(`#uf_socio${this.kSocio}`).disabled = false;

        this.setComplementoSocio("");

        this.cep_socio = null;
        this.$v.cep_socio.$touch();
      } else {
        this.setBairroSocio(dadosEndereco.bairro);
        if (dadosEndereco.bairro != "")
          document.querySelector(`#bairro_socio${this.kSocio}`).disabled = true;

        this.setCidadeSocio(dadosEndereco.localidade);
        if (dadosEndereco.localidade != "")
          document.querySelector(`#cidade_socio${this.kSocio}`).disabled = true;

        this.setLogradouroSocio(dadosEndereco.logradouro);
        if (dadosEndereco.logradouro != "")
          document.querySelector(
            `#logradouro_socio${this.kSocio}`
          ).disabled = true;

        this.setUfSocio(dadosEndereco.uf);
        if (dadosEndereco.uf != "")
          document.querySelector(`#uf_socio${this.kSocio}`).disabled = true;

        this.setComplementoSocio(dadosEndereco.complemento);

        this.cep_socio = value;
        this.$v.cep_socio.$touch();
      }
    },
    setUfSocio(value) {
      this.uf_socio = value;
      this.$v.uf_socio.$touch();
    },
    setCidadeSocio(value) {
      this.cidade_socio = value;
      this.$v.cidade_socio.$touch();
    },
    setBairroSocio(value) {
      this.bairro_socio = value;
      this.$v.bairro_socio.$touch();
    },
    setComplementoSocio(value) {
      this.complemento_socio = value;
      this.$v.complemento_socio.$touch();
    },
    setTipoLogradouroSocio(value) {
      this.tipo_logradouro_socio = value;
      this.$v.tipo_logradouro_socio.$touch();
    },
    setLogradouroSocio(value) {
      this.logradouro_socio = value;
      this.$v.logradouro_socio.$touch();
    },
    setNumeroSocio(value) {
      this.numero_socio = value;
      this.$v.numero_socio.$touch();
    },
    setDados() {
      this.$store.commit("SET_SOCIOS_SOLICITACAO", {
        kSocio: this.kSocio,
        nome_socio: this.nome_socio,
        cpf_socio: this.cpf_socio,
        uf_rg_socio: this.uf_rg_socio,
        numero_rg_socio: this.numero_rg_socio,
        sexo_socio: this.sexo_socio,
        estado_civil_socio: this.estado_civil_socio,
        email_socio: this.email_socio,
        telefone_socio: this.telefone_socio,
        cep_socio: this.cep_socio,
        uf_socio: this.uf_socio,
        cidade_socio: this.cidade_socio,
        bairro_socio: this.bairro_socio,
        tipo_logradouro_socio: this.tipo_logradouro_socio,
        logradouro_socio: this.logradouro_socio,
        numero_socio: this.numero_socio,
        complemento_socio: this.complemento_socio,
      });
      this.$store.commit("GET_ERRORS", { invalid: this.$v.$invalid });
    },
  },
};
</script>

<style>
</style>