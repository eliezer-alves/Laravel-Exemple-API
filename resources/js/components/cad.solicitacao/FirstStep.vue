<template>
  <solicitacao>
    <div class="p-4 h-screen">
      <div class="my-1">
        <div class="w-full bg-teal-700 text-lg text-white pl-1 py-2 rounded-sm">
          Dados da Simulação
        </div>
        <div class="flex lg:flex-row md:flex-row flex-col">
          <img
            class="mx-auto lg:w-72 w-44 my-5"
            src="/images/undraw_Success_factors_re_ce93.svg"
            alt="Simulacao"
          />
          <div class="grid lg:grid-cols-12 md:grid-cols-12">
            <div
              class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="valor_solicitado">Valor Solicitado</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="valor_solicitado"
                  name="valor_solicitado"
                  placeholder="Nome da Empresa"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800 form__input"
                  :value="$v.solicitacao.valor_solicitado.$model"
                  v-money="money"
                  @input="setValorSolicitado($event.target.value)"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.valor_solicitado.$dirty &&
                  !$v.solicitacao.valor_solicitado.required
                "
              >
                Valor obrigatório
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.valor_solicitado.$dirty &&
                  !$v.solicitacao.valor_solicitado.minValue
                "
              >
                Valor mínimo de R${{
                  $v.solicitacao.valor_solicitado.$params.minValue.min / 100
                }},00
              </div>
            </div>
            <div
              class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="parcelas">Parcelas</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="parcelas"
                  name="parcelas"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="number"
                  v-model.number="$v.solicitacao.parcelas.$model"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.parcelas.$dirty &&
                  !$v.solicitacao.parcelas.required
                "
              >
                Parcela(s) obrigatória
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.parcelas.$dirty &&
                  !$v.solicitacao.parcelas.between
                "
              >
                Parcelas entre
                {{ $v.solicitacao.parcelas.$params.between.min }} e
                {{ $v.solicitacao.parcelas.$params.between.max }}
              </div>
            </div>
            <div
              class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="data_geracao_proposta">Data da Geração</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="data_geracao_proposta"
                  name="data_geracao_proposta"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="date"
                  v-model="$v.solicitacao.data_geracao_proposta.$model"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.data_geracao_proposta.$dirty &&
                  !$v.solicitacao.data_geracao_proposta.required
                "
              >
                Data obrigatória
              </div>
            </div>
            <div
              class="lg:col-span-6 md:col-span-6 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
            >
              <div
                class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
              >
                <label for="primeiro_vencimento">1º Vencimento</label>
              </div>
              <div class="bg-white my-2 p-1 border border-gray-200 rounded">
                <input
                  id="primeiro_vencimento"
                  name="primeiro_vencimento"
                  class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                  type="date"
                  v-model="$v.solicitacao.primeiro_vencimento.$model"
                />
              </div>
              <div
                class="text-red-600"
                v-if="
                  $v.solicitacao.primeiro_vencimento.$dirty &&
                  !$v.solicitacao.primeiro_vencimento.required
                "
              >
                Data obrigatória
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="flex p-2 mt-4">
        <router-link :to="{ name: 'home' }">
          <button
            class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-gray-300 bg-gray-100 text-gray-700 border duration-200 ease-in-out border-gray-600 transition"
          >
            Finalizar
          </button>
        </router-link>
        <div class="flex-auto flex flex-row-reverse">
          <button
            @click="validateFields"
            :class="{ 'opacity-40': $v.$invalid }"
            class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
          >
            Avançar
          </button>

          <button
            class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-200 bg-teal-100 text-teal-700 border duration-200 ease-in-out border-teal-600 transition"
          >
            Simular
          </button>
        </div>
      </div>
    </div>
  </solicitacao>
</template>

<script>
import { mapGetters } from "vuex";
import { mapFields } from "vuex-map-fields";

import { required, minValue, between } from "vuelidate/lib/validators";

import Solicitacao from "../Solicitacao.vue";

export default {
  components: { Solicitacao },
  computed: {
    ...mapGetters(["solicitacao"]),
    ...mapFields(["solicitacao", "errors"]),
  },
  data() {
    return {
      money: {
        decimal: ",",
        thousands: ".",
        prefix: "R$ ",
        precision: 2,
      },
    };
  },
  validations: {
    solicitacao: {
      valor_solicitado: {
        required,
        minValue: minValue(1000000),
      },
      parcelas: {
        required,
        between: between(1, 36),
      },
      data_geracao_proposta: {
        required,
      },
      primeiro_vencimento: {
        required,
      },
    },
  },
  methods: {
    setValorSolicitado(value) {
      value = value.replace(/[^\d]+/g, "");
      this.solicitacao.valor_solicitado = value;
      this.$v.solicitacao.valor_solicitado.$touch();
    },
    validateFields() {
      if (!this.$v.$invalid) {
        this.$router.push("solicitacao-2");
      }
      this.$v.$touch();
    },
  },
};
</script>

<style>
</style>