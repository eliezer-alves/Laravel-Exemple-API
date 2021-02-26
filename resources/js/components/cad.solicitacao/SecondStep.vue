<template>
  <solicitacao>
    <div class="p-4 min-h-screen">
      <div class="my-1">
        <div class="w-full bg-teal-700 text-lg text-white pl-1 py-2 rounded-sm">
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
              />
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
                placeholder="##.###.###/####-##"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                v-mask="'##.###.###/####-##'"
              />
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
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
                placeholder="Nome Fantasia"
              />
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
                placeholder="##.###.####-#"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                v-mask="'##.###.####-#'"
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
        <div class="flex-auto flex lg:flex-row-reverse md:flex-row-reverse">
          <router-link :to="{ name: 'solicitacao-2' }">
            <button
              class="text-base mx-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
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