<template>
  <solicitacao>
    <div class="p-4">
      <div class="my-2">
        <div class="w-full bg-teal-700 text-lg text-white pl-3 py-2 rounded-sm">
          Dados da Empresa
        </div>
        <div class="grid lg:grid-cols-12 md:grid-cols-12">
          <div
            class="lg:col-span-7 md:col-span-7 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="razao_social">Razão Social</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="razao_social"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="Razão Social"
                :value="$v.razao_social.$model"
                @input="setRazaoSocial($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="$v.razao_social.$dirty && !$v.razao_social.required"
            >
              Razão social é obrigatório.
            </div>
          </div>
          <div
            class="lg:col-span-5 md:col-span-5 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="cnpj">CNPJ</label>
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <input
                id="cnpj"
                name="cnpj"
                placeholder="##.###.###/####-##"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                v-mask="'##.###.###/####-##'"
                :value="cnpj"
                @input="setCnpj($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="$v.cnpj.$dirty && !$v.cnpj.required"
            >
              CNPJ é obrigatório.
            </div>
            <div
              class="text-red-600"
              v-if="$v.cnpj.$dirty && !$v.cnpj.validarCNPJ"
            >
              CNPJ inválido.
            </div>
          </div>
          <div
            class="lg:col-span-7 md:col-span-7 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="nome_fantasia">Nome Fantasia</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="nome_fantasia"
                name="nome_fantasia"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="Nome Fantasia"
                :value="$v.nome_fantasia.$model"
                @input="setNomeFantasia($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="$v.nome_fantasia.$dirty && !$v.nome_fantasia.required"
            >
              Nome Fantasia é obrigatório.
            </div>
          </div>
          <div
            class="lg:col-span-5 md:col-span-5 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="inscricao_estadual">Inscrição Estadual</label>
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <input
                id="inscricao_estadual"
                name="inscricao_estadual"
                placeholder="##.###.####-#"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                v-mask="'##.###.####-#'"
                :value="$v.inscricao_estadual.$model"
                @input="setInscricaoEstadual($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.inscricao_estadual.$dirty && !$v.inscricao_estadual.required
              "
            >
              Inscrição Estadual é obrigatório.
            </div>
          </div>
          <div
            class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="rendimento_mensal">Rendimento Mensal</label>
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <input
                id="rendimento_mensal"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                v-money="money"
                :value="$v.rendimento_mensal.$model"
                @input="setRendimentoMensal($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.rendimento_mensal.$dirty && !$v.rendimento_mensal.required
              "
            >
              Rendimento Mensal é obrigatório.
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.rendimento_mensal.$dirty && !$v.rendimento_mensal.minValue
              "
            >
              Valor mínimo de R$
              {{ $v.rendimento_mensal.$params.minValue.min }},00.
            </div>
          </div>
          <div
            class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label>Atividade Comercial</label>
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <select
                id="id_atividade_comercial"
                name="id_atividade_comercial"
                class="p-1 px-2 outline-none w-full text-gray-800"
                :value="$v.id_atividade_comercial.$model"
                @change="setIdAtividadeComercial($event.target.value)"
              >
                <option value="" selected>--</option>
                <option
                  v-for="atividade in atividades"
                  :key="atividade.id_atividade_comercial"
                  :value="atividade.id_atividade_comercial"
                >
                  {{ atividade.descricao }}
                </option>
              </select>
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.id_atividade_comercial.$dirty &&
                !$v.id_atividade_comercial.required
              "
            >
              Atividade Comercial é obrigatório.
            </div>
          </div>
          <div
            class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="tipo_empresa">Tipo de Empresa</label>
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <select
                id="tipo_empresa"
                name="tipo_empresa"
                class="p-1 px-2 outline-none w-full text-gray-800"
                :value="$v.tipo_empresa.$model"
                @change="setTipoEmpresa($event.target.value)"
              >
                <option value="" selected>--</option>
                <option value="0">PJ Sociedade</option>
                <option value="1">PJ Individual</option>
                <option value="2">Pessoa Física</option>
              </select>
            </div>
            <div
              class="text-red-600"
              v-if="$v.tipo_empresa.$dirty && !$v.tipo_empresa.required"
            >
              Tipo de Empresa é obrigatório.
            </div>
          </div>
        </div>
      </div>

      <div class="my-2">
        <div class="w-full bg-teal-700 text-lg text-white pl-3 py-2 rounded-sm">
          Endereço / Contato
        </div>
        <div class="grid lg:grid-cols-12 md:grid-cols-12">
          <div
            class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="cep">CEP</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="cep"
                name="cep"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="#####-###"
                v-mask="'#####-###'"
                :value="$v.cep.$model"
                @input="setCep($event.target.value)"
              />
            </div>
            <div class="text-red-600" v-if="$v.cep.$dirty && !$v.cep.required">
              CEP é obrigatório.
            </div>
          </div>
          <div
            class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="uf">UF</label>
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <select
                id="uf"
                name="uf"
                class="p-1 px-2 outline-none w-full text-gray-800"
                :value="$v.uf.$model"
                @change="setUf($event.target.value)"
              >
                <option value="">--</option>
                <option value="MG">Minas Gerais</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="SP">São Paulo</option>
              </select>
            </div>
            <div class="text-red-600" v-if="$v.uf.$dirty && !$v.uf.required">
              UF é obrigatório.
            </div>
          </div>
          <div
            class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="cidade">Cidade</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="cidade"
                name="cidade"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="Cidade"
                :value="$v.cidade.$model"
                @input="setCidade($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="$v.cidade.$dirty && !$v.cidade.required"
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
              <label for="bairro">Bairro</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="bairro"
                name="bairro"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="Bairro"
                :value="$v.bairro.$model"
                @input="setBairro($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="$v.bairro.$dirty && !$v.bairro.required"
            >
              Bairro é obrigatório.
            </div>
          </div>
          <div
            class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="tipo_logradouro">Tipo de Logradouro</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="tipo_logradouro"
                name="tipo_logradouro"
                class="p-1 px-2 outline-none w-full text-gray-800"
                :value="$v.tipo_logradouro.$model"
                @change="setTipoLogradouro($event.target.value)"
              >
                <option value="">--</option>
                <option value="1">Rua</option>
                <option value="2">Avenida</option>
                <option value="3">Praça</option>
              </select>
            </div>
            <div
              class="text-red-600"
              v-if="$v.tipo_logradouro.$dirty && !$v.tipo_logradouro.required"
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
              <label for="logradouro">Logradouro</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="logradouro"
                name="logradouro"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                :value="$v.logradouro.$model"
                @input="setLogradouro($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="$v.logradouro.$dirty && !$v.logradouro.required"
            >
              Logradouro é obrigatório.
            </div>
          </div>
          <div
            class="lg:col-span-1 md:col-span-1 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="numero">Número</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="numero"
                name="numero"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="number"
                :value="$v.numero.$model"
                @input="setNumero($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="$v.numero.$dirty && !$v.numero.required"
            >
              Número é obrigatório.
            </div>
          </div>
          <div
            class="lg:col-span-5 md:col-span-5 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="complemento">Complemento</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="complemento"
                name="complemento"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                :value="$v.complemento.$model"
                @input="setComplemento($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="$v.complemento.$dirty && !$v.complemento.required"
            >
              Complemento é obrigatório.
            </div>
          </div>
          <div
            class="lg:col-span-3 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="telefone">Telefone</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="telefone"
                name="telefone"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                v-mask="['(##) ####-####', '(##) #####-####']"
                :value="$v.telefone.$model"
                @input="setTelefone($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="$v.telefone.$dirty && !$v.telefone.required"
            >
              Telefone é obrigatório.
            </div>
            <div
              class="text-red-600"
              v-if="$v.telefone.$dirty && !$v.telefone.minLength"
            >
              Digite um telefone válido length.
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="email">E-mail</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="email"
                name="email"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="email"
                :value="$v.email.$model"
                @input="setEmail($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="$v.email.$dirty && !$v.email.required"
            >
              E-mail é obrigatório.
            </div>
          </div>
        </div>
      </div>

      <div class="my-2">
        <div class="w-full bg-teal-700 text-lg text-white pl-3 py-2 rounded-sm">
          Arquivos do Contrato Social
        </div>

        <div
          class="flex lg:flex-row md:flex-row flex-col font-bold text-gray-600 text-xs leading-8 uppercase mx-2 mt-3"
        >
          <div class="self-center">
            <label
              class="w-56 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-teal-800 cursor-pointer hover:bg-teal-800 hover:text-white"
            >
              <svg
                class="w-8 h-8"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <path
                  d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"
                />
              </svg>
              <span class="mt-2 text-base leading-normal"
                >Selecione o arquivo</span
              >
              <input
                id="contrato_social"
                name="contrato_social"
                type="file"
                class="hidden"
              />
            </label>
          </div>

          <div class="lg:ml-5 md:ml-5 self-center">
            <span class="text-base leading-normal">
              Nome do Arquivo Selecionado
            </span>
          </div>
        </div>
        <div class="flex flex-row-reverse">
          <button
            class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 mx-1 rounded font-bold cursor-pointer hover:bg-red-200 bg-red-100 text-red-700 border duration-200 ease-in-out border-red-600 transition"
          >
            Remover
          </button>
          <button
            class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 mx-1 rounded font-bold cursor-pointer hover:bg-teal-200 bg-teal-100 text-teal-700 border duration-200 ease-in-out border-teal-600 transition"
          >
            Novo Documento
          </button>
        </div>
      </div>

      <div class="flex p-2 mt-5">
        <button
          class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-gray-300 bg-gray-100 text-gray-700 border duration-200 ease-in-out border-gray-600 transition"
        >
          Finalizar
        </button>
        <div class="flex-auto flex lg:flex-row-reverse md:flex-row-reverse">
          <router-link :to="{ name: 'solicitacao-3' }">
            <button
              v-show="!$v.$invalid"
              class="text-base mx-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
            >
              Avançar
            </button>
          </router-link>
          <router-link :to="{ name: 'solicitacao' }">
            <button
              class="text-base mx-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
            >
              Retornar
            </button>
          </router-link>
        </div>
      </div>
    </div>
  </solicitacao>
</template>

<script>
import { mapGetters } from "vuex";
import { required, minValue, minLength, email } from "vuelidate/lib/validators";
import { validarCNPJ } from "../../helper.js";

import Solicitacao from "../Solicitacao.vue";
export default {
  components: { Solicitacao },
  async mounted() {
    await this.$store.dispatch("fetchAtividades");
  },
  computed: {
    ...mapGetters(["atividades"]),
  },
  data() {
    return {
      money: {
        decimal: ",",
        thousands: ".",
        prefix: "R$ ",
        precision: 0,
      },
      razao_social: null,
      cnpj: "",
      nome_fantasia: null,
      inscricao_estadual: null,
      rendimento_mensal: null,
      id_atividade_comercial: null,
      tipo_empresa: null,
      cep: null,
      uf: null,
      cidade: null,
      bairro: null,
      tipo_logradouro: null,
      logradouro: null,
      numero: null,
      complemento: null,
      telefone: null,
      email: null,
    };
  },
  validations: {
    razao_social: {
      required,
    },
    cnpj: {
      required,
    },
    nome_fantasia: {
      required,
    },
    inscricao_estadual: {
      required,
    },
    rendimento_mensal: {
      required,
      minValue: minValue(1),
    },
    id_atividade_comercial: {
      required,
    },
    tipo_empresa: {
      required,
    },
    cep: {
      required,
    },
    uf: {
      required,
    },
    cidade: {
      required,
    },
    bairro: {
      required,
    },
    tipo_logradouro: {
      required,
    },
    logradouro: {
      required,
    },
    numero: {
      required,
    },
    complemento: {},
    telefone: {
      required,
      minLength: minLength(10),
    },
    email: {
      required,
      email,
    },
  },
  methods: {
    setRazaoSocial(value) {
      this.razao_social = value;
      this.$v.razao_social.$touch();
    },
    setCnpj(value) {
      value = value.replace(/[^\d]+/g, "");
      this.$v.cnpj.validarCNPJ = true;
      if (!validarCNPJ(value)) {
        this.$v.cnpj.validarCNPJ = false;
      }
      this.cnpj = value;
      this.$v.cnpj.$touch();
    },
    setNomeFantasia(value) {
      this.nome_fantasia = value;
      this.$v.nome_fantasia.$touch();
    },
    setInscricaoEstadual(value) {
      this.inscricao_estadual = value;
      this.$v.inscricao_estadual.$touch();
    },
    setRendimentoMensal(value) {
      value = value.replace(/[^\d]+/g, "");
      this.rendimento_mensal = value;
      this.$v.rendimento_mensal.$touch();
    },
    setIdAtividadeComercial(value) {
      this.id_atividade_comercial = value;
      this.$v.id_atividade_comercial.$touch();
    },
    setTipoEmpresa(value) {
      this.tipo_empresa = value;
      this.$v.tipo_empresa.$touch();
    },
    setCep(value) {
      this.cep = value;
      this.$v.cep.$touch();
    },
    setUf(value) {
      this.uf = value;
      this.$v.uf.$touch();
    },
    setCidade(value) {
      this.cidade = value;
      this.$v.cidade.$touch();
    },
    setBairro(value) {
      this.bairro = value;
      this.$v.bairro.$touch();
    },
    setTipoLogradouro(value) {
      this.tipo_logradouro = value;
      this.$v.tipo_logradouro.$touch();
    },
    setLogradouro(value) {
      this.logradouro = value;
      this.$v.logradouro.$touch();
    },
    setNumero(value) {
      this.numero = value;
      this.$v.numero.$touch();
    },
    setComplemento(value) {
      this.complemento = value;
      this.$v.complemento.$touch();
    },
    setTelefone(value) {
      value = value.replace(/[^\d]+/g, "");
      this.telefone = value;
      this.$v.telefone.$touch();
    },
    setEmail(value) {
      this.email = value;
      this.$v.email.$touch();
    },
  },
};
</script>

<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>