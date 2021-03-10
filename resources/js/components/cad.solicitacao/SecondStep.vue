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
                v-model.trim="$v.solicitacao.razao_social.$model"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.razao_social.$dirty &&
                !$v.solicitacao.razao_social.required
              "
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
                :value="$v.solicitacao.cnpj.$model"
                @input="setCnpj($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="$v.solicitacao.cnpj.$dirty && !$v.solicitacao.cnpj.required"
            >
              CNPJ é obrigatório.
            </div>
            <div
              class="text-red-600"
              v-if="$v.solicitacao.cnpj.$dirty && !$v.solicitacao.cnpj.valid"
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
                v-model.trim="$v.solicitacao.nome_fantasia.$model"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.nome_fantasia.$dirty &&
                !$v.solicitacao.nome_fantasia.required
              "
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
                :value="$v.solicitacao.inscricao_estadual.$model"
                @input="setInscricaoEstadual($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.inscricao_estadual.$dirty &&
                !$v.solicitacao.inscricao_estadual.required
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
                :value="$v.solicitacao.rendimento_mensal.$model"
                @input="setRendimentoMensal($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.rendimento_mensal.$dirty &&
                !$v.solicitacao.rendimento_mensal.required
              "
            >
              Rendimento Mensal é obrigatório.
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.rendimento_mensal.$dirty &&
                !$v.solicitacao.rendimento_mensal.minValue
              "
            >
              Valor mínimo de R$
              {{
                $v.solicitacao.rendimento_mensal.$params.minValue.min / 100
              }},00.
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
                v-model="$v.solicitacao.id_atividade_comercial.$model"
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
                $v.solicitacao.id_atividade_comercial.$dirty &&
                !$v.solicitacao.id_atividade_comercial.required
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
                v-model="$v.solicitacao.tipo_empresa.$model"
              >
                <option value="" selected>--</option>
                <option value="0">PJ Sociedade</option>
                <option value="1">PJ Individual</option>
                <option value="2">Pessoa Física</option>
              </select>
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.tipo_empresa.$dirty &&
                !$v.solicitacao.tipo_empresa.required
              "
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
                :value="$v.solicitacao.cep.$model"
                @blur="setCep($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="$v.solicitacao.cep.$dirty && !$v.solicitacao.cep.required"
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
              <label for="uf">UF</label>
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <select
                id="uf"
                name="uf"
                class="p-1 px-2 outline-none w-full text-gray-800"
                v-model="$v.solicitacao.uf.$model"
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
              v-if="$v.solicitacao.uf.$dirty && !$v.solicitacao.uf.required"
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
              <label for="cidade">Cidade</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="cidade"
                name="cidade"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="Cidade"
                v-model="$v.solicitacao.cidade.$model"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.cidade.$dirty && !$v.solicitacao.cidade.required
              "
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
                v-model="$v.solicitacao.bairro.$model"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.bairro.$dirty && !$v.solicitacao.bairro.required
              "
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
              <label for="tipo_logradouro">Tipo de Logradouro</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="tipo_logradouro"
                name="tipo_logradouro"
                class="p-1 px-2 outline-none w-full text-gray-800"
                v-model="$v.solicitacao.tipo_logradouro.$model"
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
                $v.solicitacao.tipo_logradouro.$dirty &&
                !$v.solicitacao.tipo_logradouro.required
              "
            >
              Tipo de Logradouro é obrigatório.
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
                v-model="$v.solicitacao.logradouro.$model"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.logradouro.$dirty &&
                !$v.solicitacao.logradouro.required
              "
            >
              Logradouro é obrigatório.
            </div>
          </div>
          <div
            class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
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
                v-model="$v.solicitacao.numero.$model"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.numero.$dirty && !$v.solicitacao.numero.required
              "
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
                v-model="$v.solicitacao.complemento.$model"
              />
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
                :value="$v.solicitacao.telefone.$model"
                @input="setTelefone($event.target.value)"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.telefone.$dirty &&
                !$v.solicitacao.telefone.required
              "
            >
              Telefone é obrigatório.
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.telefone.$dirty &&
                !$v.solicitacao.telefone.minLength
              "
            >
              Tamanho válido.
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
                v-model="$v.solicitacao.email.$model"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.email.$dirty && !$v.solicitacao.email.required
              "
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

        <component
          class="flex justify-between"
          v-for="doc in this.solicitacao.docs"
          :is="'contrato-upload'"
          :id="doc.id"
          :key="doc.id"
          @remove="removeDocElement"
        />

        <div class="flex flex-row-reverse my-5">
          <button
            @click="addDocElement"
            :disabled="!this.validDocElement"
            :class="{ 'opacity-50': !this.validDocElement }"
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
        <div class="flex-auto flex flex-row-reverse">
          <button
            @click="validateFields"
            :class="{ 'opacity-40': $v.$invalid }"
            class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
          >
            Avançar
          </button>

          <router-link :to="{ name: 'solicitacao' }">
            <button
              class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
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
import { mapFields } from "vuex-map-fields";
import { required, minValue, minLength, email } from "vuelidate/lib/validators";
import { validarCNPJ } from "../../helper.js";
import Solicitacao from "../Solicitacao.vue";
import ContratoUpload from "./ContratoUpload.vue";

export default {
  components: { Solicitacao, ContratoUpload },
  async mounted() {
    await this.$store.dispatch("fetchAtividades");
    await this.$store.dispatch("fetchDominios");
  },
  computed: {
    ...mapGetters(["solicitacao", "atividades", "dominios"]),
    ...mapFields(["solicitacao", "errors"]),
    validDocElement: function () {
      const index = this.solicitacao.docs.findIndex(
        (doc) => doc.file === "" || doc.valid === false
      );
      // console.log('Encontrou');
      // console.log(index);
      if (index >= 0) return false;
      return true;
    },
  },
  data() {
    return {
      money: {
        decimal: ",",
        thousands: ".",
        prefix: "R$ ",
        precision: 2,
      },
      docElements: 0,
    };
  },
  validations: {
    solicitacao: {
      razao_social: { required },
      cnpj: { required },
      nome_fantasia: { required },
      inscricao_estadual: { required },
      rendimento_mensal: { required, minValue: minValue(100) },
      id_atividade_comercial: { required },
      tipo_empresa: { required },
      cep: { required },
      uf: { required },
      cidade: { required },
      bairro: { required },
      tipo_logradouro: { required },
      logradouro: { required },
      numero: { required },
      complemento: {},
      telefone: { required, minLength: minLength(10) },
      email: { required, email },
    },
  },
  methods: {
    setCnpj(value) {
      value = value.replace(/[^\d]+/g, "");
      this.$v.solicitacao.cnpj.valid = validarCNPJ(value);
      this.solicitacao.cnpj = value;
      this.$v.solicitacao.cnpj.$touch();
    },
    setInscricaoEstadual(value) {
      value = value.replace(/[^\d]+/g, "");
      this.solicitacao.inscricao_estadual = value;
      this.$v.solicitacao.inscricao_estadual.$touch();
    },
    setRendimentoMensal(value) {
      value = value.replace(/[^\d]+/g, "");
      this.solicitacao.rendimento_mensal = value;
      this.$v.solicitacao.rendimento_mensal.$touch();
    },
    async setCep(value) {
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

        this.solicitacao.cep = null;
        this.$v.solicitacao.cep.$touch();
      } else {
        this.setBairro(dadosEndereco.bairro);
        if (dadosEndereco.bairro != "")
          document.querySelector("#bairro").disabled = true;

        this.setCidade(dadosEndereco.localidade);
        if (dadosEndereco.localidade != "")
          document.querySelector("#cidade").disabled = true;

        this.setLogradouro(dadosEndereco.logradouro);
        if (dadosEndereco.logradouro != "")
          document.querySelector("#logradouro").disabled = true;

        this.setUf(dadosEndereco.uf);
        if (dadosEndereco.uf != "")
          document.querySelector("#uf").disabled = true;

        this.setComplemento(dadosEndereco.complemento);

        this.solicitacao.cep = value;
        this.$v.solicitacao.cep.$touch();
      }
    },
    setBairro(value) {
      this.solicitacao.bairro = value;
      this.$v.solicitacao.bairro.$touch();
    },
    setCidade(value) {
      this.solicitacao.cidade = value;
      this.$v.solicitacao.cidade.$touch();
    },
    setLogradouro(value) {
      this.solicitacao.logradouro = value;
      this.$v.solicitacao.logradouro.$touch();
    },
    setUf(value) {
      this.solicitacao.uf = value;
      this.$v.solicitacao.uf.$touch();
    },
    setComplemento(value) {
      this.solicitacao.complemento = value;
      this.$v.solicitacao.complemento.$touch();
    },
    setTelefone(value) {
      value = value.replace(/[^\d]+/g, "");
      this.solicitacao.telefone = value;
      this.$v.solicitacao.telefone.$touch();
    },

    addDocElement() {
      this.solicitacao.docs.push({
        file: "",
        valid: false,
        id: this.docElements++,
      });
    },
    removeDocElement(id) {
      const index = this.solicitacao.docs.findIndex((f) => f.id === id);
      this.solicitacao.docs.splice(index, 1);
    },

    validateFields() {
      if (!this.$v.$invalid) {
        this.$router.push("solicitacao-3");
      }
      this.$v.$touch();
    },
  },
};
</script>

<style>
</style>