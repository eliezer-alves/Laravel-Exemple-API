<template>
  <div class="lg:w-4/5 md:w-6/12 w-10/12 m-auto my-10 rounded-lg">
    <svg
      class="w-16 h-16 mx-auto mt- py-1"
      fill="none"
      stroke="currentColor"
      viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"
      ></path>
    </svg>
    <div class="bg-white shadow p-6 mt-5 rounded-t-lg">
      <div class="grid">
        <div
          class="border focus-within:border-green-500 focus-within:text-green-500 transition-all duration-500 relative rounded p-1"
        >
          <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
            <p>
              <label for="name" class="bg-white text-gray-600 px-1"
                >Nome da atividade *</label
              >
            </p>
          </div>
          <p>
            <input
              id="name"
              autocomplete="false"
              tabindex="0"
              type="text"
              class="py-1 px-1 text-gray-900 outline-none block h-full w-full"
            />
          </p>
        </div>
        <div class="border-t mt-6 pt-3">
          <button
            class="block w-full rounded text-gray-100 px-3 py-1 bg-green-500 hover:shadow-inner hover:bg-green-700 transition-all duration-300"
          >
            Save
          </button>
        </div>
      </div>
    </div>
    <!-- component -->
    <div class="text-gray-900 bg-gray-200 rounded-b-lg">
      <div class="p-4 flex">
        <h1 class="text-3xl">Atividades</h1>
      </div>
      <div class="px-3 py-4 flex justify-center">
        <table class="w-full text-md bg-white shadow-md rounded mb-4">
          <tbody>
            <tr class="border-b">
              <th class="text-left p-3 px-5">Id</th>
              <th class="text-left p-3 px-5">Atividade</th>
              <th></th>
            </tr>
            <tr
              class="border-b hover:bg-orange-100"
              v-for="atividade in atividades"
              :key="atividade.id_atividade_comercial"
            >
              <td class="p-3 px-5">
                <input
                  type="text"
                  :value="atividade.id_atividade_comercial"
                  class="bg-transparent"
                />
              </td>
              <td class="p-3 px-5">
                <input
                  type="text"
                  :value="atividade.atividade"
                  class="bg-transparent"
                />
              </td>
              <td class="p-3 px-5 flex justify-end">
                <button
                  type="button"
                  class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                >
                  Editar</button
                ><button
                  type="button"
                  class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                >
                  Remover
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {};
  },
  mounted() {
    this.$store.dispatch("fetchAtividades");
  },
  methods: {
    deleteAtividade(atividade) {
      this.$store.dispatch("deleteAtividade", atividade);
    },
  },
  computed: {
    ...mapGetters(["atividades"]),
  },
};
</script>
<style>
</style>