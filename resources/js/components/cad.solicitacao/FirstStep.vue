<template>
  <solicitacao>
    <div class="p-4">
      <div>
        <p class="text-3xl my-5 font-bold">Fase - 1</p>
      </div>
      <div class="my-1">
        <div class="w-full bg-teal-700 text-lg text-white pl-1 py-2 rounded-sm">
          Dados do Cliente
        </div>
        <div class="flex flex-col md:flex-row">
          <div class="w-full flex-1 mx-2">
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              Nome da Empresa
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <input
                placeholder="Nome da Empresa"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
              />
            </div>
          </div>
          <div class="w-full flex-1 mx-2">
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              CNPJ
            </div>
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <input
                placeholder="##.###.###/####-##"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                v-mask="'##.###.###/####-##'"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="my-1">
        <div class="w-full bg-teal-700 text-lg text-white pl-1 py-2 rounded-sm">
          Dados da Simulação
        </div>

        <div class="grid lg:grid-cols-12 md:grid-cols-12 grid-flow-col">
          <div
            class="lg:col-span-2 md:col-span-3 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="valor_solicitado">Valor Solicitado</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="valor_solicitado"
                placeholder="Nome da Empresa"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                v-model.lazy="price"
                v-money="money"
              />
            </div>
          </div>
          <div
            class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="parcelas">Parcelas</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="parcelas"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="number"
                value="10"
              />
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="data_geracao_proposta">Data da Geração</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="data_geracao_proposta"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="date"
              />
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="primeiro_vencimento">1º Vencimento</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="primeiro_vencimento"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="date"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="flex p-2 mt-4">
        <button
          class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-gray-200 bg-gray-100 text-gray-700 border duration-200 ease-in-out border-gray-600 transition"
        >
          Finalizar
        </button>
        <div class="flex-auto flex flex-row-reverse">
          <router-link :to="{ name: 'solicitacao-2' }">
            <button
              class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
            >
              Avançar
            </button>
          </router-link>
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
import Solicitacao from "../Solicitacao.vue";
export default {
  components: { Solicitacao },
  data() {
    return {
      price: 123.45,
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
};
</script>

<style>
</style>