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
      <form @submit="createAtividade(newAtividade)">
        <div class="grid">
          <div
            class="border focus-within:border-green-700 focus-within:text-green-700 transition-all duration-500 relative rounded p-1"
          >
            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
              <p>
                <label for="atividade" class="bg-white text-gray-600 px-1"
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
                v-model="newAtividade.descricao"
              />
            </p>
          </div>
          <div class="border-t mt-6 pt-3">
            <button
              class="block w-full rounded text-gray-100 px-3 py-1 bg-green-700 hover:shadow-inner hover:bg-green-900 transition-all duration-300"
              @click.prevent="createAtividade(newAtividade)"
            >
              Save
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="mx-auto w-full">
      <clip-loader
        :loading="true"
        :color="'#047857'"
        :size="'40px'"
        v-if="loading"
        class="mt-10"
      ></clip-loader>
      <!-- component -->
      <div class="text-gray-900 bg-gray-200 rounded-b-lg" v-else>
        <div class="p-4 flex">
          <h1 class="text-3xl">Atividades Comerciais</h1>
        </div>
        <div class="px-3 py-4 flex justify-center">
          <table class="w-full text-md bg-white shadow-md rounded mb-4">
            <tbody>
              <tr class="border-b">
                <th class="text-left p-3 px-5">Código</th>
                <th class="text-left p-3 px-5">Descrição</th>
                <th></th>
              </tr>
              <tr
                class="border-b hover:bg-orange-100"
                v-for="atividade in atividades"
                :key="atividade.id_atividade_comercial"
              >
                <td class="p-3 px-5">
                  <p class="bg-transparent">
                    {{ atividade.id_atividade_comercial }}
                  </p>
                </td>
                <td class="p-3 px-5">
                  <input
                    type="text"
                    v-model="atividade.descricao"
                    class="bg-transparent w-full"
                    @blur="updateAtividade(atividade)"
                  />
                </td>
                <td class="p-3 px-5 flex justify-end">
                  <button
                    type="button"
                    class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                    @click="deleteAtividade(atividade)"
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
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import ClipLoader from "vue-spinner/src/ClipLoader.vue";

export default {
  components: {
    ClipLoader,
  },
  data() {
    return {
      newAtividade: {
        descricao: "",
      },
      loading: false,
    };
  },
  async mounted() {
    this.loading = true;
    await this.$store.dispatch("fetchAtividades");
    this.loading = false;
  },
  methods: {
    async createAtividade(atividade) {
      this.loading = true;
      await this.$store.dispatch("createAtividade", atividade);
      this.loading = false;
    },
    async updateAtividade(atividade) {
      this.loading = true;
      await this.$store.dispatch("updateAtividade", atividade);
      this.loading = false;
    },
    async deleteAtividade(atividade) {
      this.loading = true;
      await this.$store.dispatch("deleteAtividade", atividade);
      this.loading = false;
    },
  },
  computed: {
    ...mapGetters(["atividades"]),
    /* atividade: {
      get() {
        return this.$store.state.atividade[this.id_atividade_comercial];
      },
      set(atividade) {
        this.updateAtividade(atividade);
      },
    }, */
  },
};
</script>
<style>
</style>