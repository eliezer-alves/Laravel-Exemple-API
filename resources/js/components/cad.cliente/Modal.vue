<template>
  <div class="fixed z-10 inset-0 overflow-y-auto">
    <div
      class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
    >
      <!--
      Background overlay, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
      <div class="fixed inset-0 transition-opacity" aria-hidden="true">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>

      <!-- This element is to trick the browser into centering the modal contents. -->
      <span
        class="hidden sm:inline-block sm:align-middle sm:h-screen"
        aria-hidden="true"
        >&#8203;</span
      >
      <!--
      Modal panel, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        To: "opacity-100 translate-y-0 sm:scale-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100 translate-y-0 sm:scale-100"
        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    -->
      <div
        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-headline"
      >
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div
              class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
            >
              <!-- Heroicon name: outline/exclamation -->
              <svg
                class="h-6 w-6 text-red-600"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                aria-hidden="true"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                />
              </svg>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3
                class="text-lg leading-6 font-medium text-gray-900"
                id="modal-headline"
              >
                Erro ao realizar cadastro
              </h3>
              <div class="mt-2">
                <p class="text-sm text-gray-500">
                  Por favor, verifique se os dados são todos válidos.
                </p>
              </div>
              <ul class="mt-5 px-1 text-sm text-red-600 list-none">
                <li v-for="cnpj in errors.cnpj" :key="cnpj">
                  {{ cnpj }}
                </li>
                <li
                  v-for="inscricao_estadual in errors.inscricao_estadual"
                  :key="inscricao_estadual"
                >
                  {{ inscricao_estadual }}
                </li>
                <li
                  v-for="id_atividade_comercial in errors.id_atividade_comercial"
                  :key="id_atividade_comercial"
                >
                  {{ id_atividade_comercial }}
                </li>
                <li
                  v-for="nome_fantasia in errors.nome_fantasia"
                  :key="nome_fantasia"
                >
                  {{ nome_fantasia }}
                </li>
                <li
                  v-for="razao_social in errors.razao_social"
                  :key="razao_social"
                >
                  {{ razao_social }}
                </li>
                <li v-for="celular in errors.celular" :key="celular">
                  {{ celular }}
                </li>
                <li v-for="email in errors.email" :key="email">
                  {{ email }}
                </li>
                <li
                  v-for="email_confirmation in errors.email_confirmation"
                  :key="email_confirmation"
                >
                  {{ email_confirmation }}
                </li>
                <li v-for="senha in errors.senha" :key="senha">
                  {{ senha }}
                </li>
                <li
                  v-for="senha_confirmation in errors.senha_confirmation"
                  :key="senha_confirmation"
                >
                  {{ senha_confirmation }}
                </li>
                <li v-for="cep in errors.cep" :key="cep">
                  {{ cep }}
                </li>
                <li v-for="uf in errors.uf" :key="uf">
                  {{ uf }}
                </li>
                <li v-for="cidade in errors.cidade" :key="cidade">
                  {{ cidade }}
                </li>
                <li v-for="bairro in errors.bairro" :key="bairro">
                  {{ bairro }}
                </li>
                <li
                  v-for="id_tipo_logradouro in errors.id_tipo_logradouro"
                  :key="id_tipo_logradouro"
                >
                  {{ id_tipo_logradouro }}
                </li>
                <li v-for="logradouro in errors.logradouro" :key="logradouro">
                  {{ logradouro }}
                </li>
                <li v-for="numero in errors.numero" :key="numero">
                  {{ numero }}
                </li>
                <li
                  v-for="complemento in errors.complemento"
                  :key="complemento"
                >
                  {{ complemento }}
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button
            @click="closeModal"
            type="button"
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
          >
            Fechar
          </button>
          <!-- <button
            type="button"
            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
          >
            Cancel
          </button> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["errors"]),
  },
  methods: {
    closeModal() {
      this.$store.commit("SHOW_MODAL", false);
    },
  },
  filters: {
    clearString(string) {
      console.log(string);
      // return string.replace(/['"\[\]]+/, "");
      return string;
    },
  },
};
</script>

<style>
</style>