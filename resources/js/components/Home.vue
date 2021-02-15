<template>
  <div class="flex flex-col sm:flex-row sm:justify-around">
    <side-bar></side-bar>
    <div class="lg:w-4/5 md:w-6/12 w-10/12 m-auto my-10">
      <h1 class="text-xl text-gray-600 font-bold">Meus contratos</h1>
      <!-- This example requires Tailwind CSS v2.0+ -->
      <div class="flex flex-col mt-3">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
          >
            <div
              class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
            >
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <!--			 -->
                  <tr>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      <input type="checkbox" name="checked" id="checked" />
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Data Solicitação
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Hora
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      N° Proposta
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      N° Contrato
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      N° Parc.
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Valor
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      1° Vencimento
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Contrato
                    </th>
                    <th
                      scope="col"
                      class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                      Status
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr>
                    <td class="px-4 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <input type="checkbox" name="" id="" />
                      </div>
                    </td>
                    <td
                      class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"
                    >
                      <div class="flex items-center">
                        <span>12/12/2020</span>
                      </div>
                    </td>
                    <td
                      class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"
                    >
                      <div class="flex items-center">
                        <span>12:00</span>
                      </div>
                    </td>
                    <td
                      class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"
                    >
                      <div class="flex items-center">547841528</div>
                    </td>
                    <td
                      class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"
                    >
                      547841528
                    </td>
                    <td
                      class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"
                    >
                      5
                    </td>
                    <td
                      class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"
                    >
                      R$12.000
                    </td>
                    <td
                      class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"
                    >
                      12/12/2021
                    </td>
                    <td
                      class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"
                    >
                      Contrato
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                      >
                        Aguardando Análise
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <router-link class="" :to="{ name: 'solicitacao' }">
        <button
          class="mt-3 block w-full text-center text-white text-lg font-bold bg-gray-500 p-4 rounded-md"
        >
          Solicitação
        </button>
      </router-link>
    </div>
  </div>
</template>
<script>
import SideBar from "./SideBar.vue";
export default {
  components: { SideBar },
  beforeCreate: function () {
    document.body.className = "home";
  },
};
</script>
<style>
.home {
  background-image: none;
  background-color: #fff;
}
</style>
