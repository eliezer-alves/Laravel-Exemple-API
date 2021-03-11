<template>
  <solicitacao>
    <div class="p-4">
      <div class="my-1">
        <div class="w-full bg-teal-700 text-lg text-white pl-1 py-2 rounded-sm">
          Dados Representante Legal
        </div>

        <div class="grid lg:grid-cols-12 md:grid-cols-12">
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="valor_solicitado">Valor Solicitado</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="valor_solicitado"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800 opacity-70"
                v-money="money"
                :value="solicitacao.valor_solicitado"
                disabled
              />
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="parcelas">Parcelas</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="parcelas"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800 opacity-70"
                type="text"
                :value="solicitacao.parcelas"
                disabled
              />
            </div>
          </div>
          <div
            class="lg:col-span-8 md:col-span-8 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="banco">Bancos</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="banco"
                name="banco"
                class="p-1 px-2 outline-none w-full text-gray-800 capitalize"
                v-model="$v.solicitacao.banco.$model"
              >
                <option value="">--</option>
                <option
                  v-for="banco in dominios.banco"
                  :key="banco.codigo"
                  :value="banco.codigo"
                  class="capitalize"
                >
                  {{ banco.descricao }}
                </option>
              </select>
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.banco.$dirty && !$v.solicitacao.banco.required
              "
            >
              Banco é obrigatório
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="forma_liberacao">Forma de Liberação</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="forma_liberacao"
                name="forma_liberacao"
                class="p-1 px-2 outline-none w-full text-gray-800"
                v-model="$v.solicitacao.forma_liberacao.$model"
              >
                <option value="">--</option>
                <option value="1">TED</option>
                <option value="2">DOC</option>
                <option value="3">PIX</option>
              </select>
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.forma_liberacao.$dirty &&
                !$v.solicitacao.forma_liberacao.required
              "
            >
              Forma de Liberação é obrigatório
            </div>
          </div>
          <div
            class="lg:col-span-10 md:col-span-10 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="agencia">Agência</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="agencia"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                v-mask="'####'"
                v-model="$v.solicitacao.agencia.$model"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.agencia.$dirty &&
                !$v.solicitacao.agencia.required
              "
            >
              Agência é obrigatório
            </div>
          </div>
          <div
            class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="digito_agencia">Dígito Agência</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="digito_agencia"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                v-mask="'####'"
                v-model="$v.solicitacao.digito_agencia.$model"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.digito_agencia.$dirty &&
                !$v.solicitacao.digito_agencia.required
              "
            >
              Digito da Agência é obrigatório
            </div>
          </div>
          <div
            class="lg:col-span-10 md:col-span-10 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="conta">Conta*</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="conta"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                v-mask="'############'"
                v-model="$v.solicitacao.conta.$model"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.conta.$dirty && !$v.solicitacao.conta.required
              "
            >
              Conta é obrigatório
            </div>
          </div>
          <div
            class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="digito_conta">Dígito Conta*</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="digito_conta"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                v-mask="'####'"
                v-model="$v.solicitacao.digito_conta.$model"
              />
            </div>
            <div
              class="text-red-600"
              v-if="
                $v.solicitacao.digito_conta.$dirty &&
                !$v.solicitacao.digito_conta.required
              "
            >
              Dígito da Conta é obrigatório
            </div>
          </div>
        </div>
      </div>

      <div class="flex p-2 mt-4">
        <button
          @click="validateFields"
          :class="{ 'opacity-40': $v.$invalid }"
          class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-gray-200 bg-gray-100 text-gray-700 border duration-200 ease-in-out border-gray-600 transition"
        >
          Finalizar
        </button>

        <div class="flex-auto flex flex-row-reverse">
          <router-link :to="{ name: 'solicitacao-3' }">
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

import Solicitacao from "../Solicitacao.vue";
import { required } from "vuelidate/lib/validators";

export default {
  components: { Solicitacao },
  computed: {
    ...mapGetters(["dominios", "solicitacao"]),
    ...mapFields(["solicitacao", "errors"]),
  },
  data() {
    return {
      money: {
        decimal: ",",
        thousands: ".",
        prefix: "R$ ",
        suffix: "",
        precision: 2,
        masked: false /* doesn't work with directive */,
      },
    };
  },
  async mounted() {
    await this.$store.dispatch("fetchDominios");
  },
  validations: {
    solicitacao: {
      banco: {
        required,
      },
      forma_liberacao: {
        required,
      },
      agencia: {
        required,
      },
      digito_agencia: {
        required,
      },
      conta: {
        required,
      },
      digito_conta: {
        required,
      },
    },
  },
  methods: {
    setBanco(value) {
      this.banco = value;
      this.$v.banco.$touch();
    },
    setFormaLiberacao(value) {
      this.forma_liberacao = value;
      this.$v.forma_liberacao.$touch();
    },
    setAgencia(value) {
      this.agencia = value;
      this.$v.agencia.$touch();
    },
    setDigitoAgencia(value) {
      this.digito_agencia = value;
      this.$v.digito_agencia.$touch();
    },
    setConta(value) {
      this.conta = value;
      this.$v.conta.$touch();
    },
    setDigitoConta(value) {
      this.digito_conta = value;
      this.$v.digito_conta.$touch();
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
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>