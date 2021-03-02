<template>
  <solicitacao>
    <div class="p-4 h-6">
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
              <label for="valor_solicitado">Valor Solicitado*</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="valor_solicitado"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
              />
            </div>
          </div>
          <div
            class="lg:col-span-4 md:col-span-4 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="parcelas">Parcelas*</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="parcelas"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
              />
            </div>
          </div>
          <div
            class="lg:col-span-8 md:col-span-8 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="bancos">Bancos</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <select
                id="banco"
                name="banco"
                class="p-1 px-2 outline-none w-full text-gray-800"
              >
                <option :value="'0001'">Banco do Brasil</option>
                <option :value="'0002'">Bradesco</option>
                <option :value="'0003'">Itau</option>
              </select>
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
              >
                <option :value="'1'">TED</option>
                <option :value="'2'">DOC</option>
                <option :value="'3'">PIX</option>
              </select>
            </div>
          </div>
          <div
            class="lg:col-span-10 md:col-span-10 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="agencia">Agência*</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="agencia"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
              />
            </div>
          </div>
          <div
            class="lg:col-span-2 md:col-span-2 col-span-full lg:mr-2 md:mr-2 sm:mr-1"
          >
            <div
              class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
            >
              <label for="digito_agencia">Dígito Agência*</label>
            </div>
            <div class="bg-white my-2 p-1 border border-gray-200 rounded">
              <input
                id="digito_agencia"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
                type="text"
              />
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
              />
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
                type="text"
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
          <router-link :to="{ name: 'finalizar' }">
            <button
              class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
            >
              Avançar
            </button>
          </router-link>
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