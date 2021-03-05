<template>
  <div>
    <div
      class="flex lg:flex-row md:flex-row flex-col font-bold text-gray-600 text-xs leading-8 uppercase mx-2 mt-3"
    >
      <div class="self-center">
        <label
          class="w-56 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-teal-800 cursor-pointer hover:bg-teal-800 hover:text-white"
          :class="{ 'bg-teal-800': file, 'text-white': file }"
        >
          <svg
            class="w-8 h-8"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <path
              d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"
            />
          </svg>
          <span
            class="mt-2 text-base text-yellow-500 leading-normal"
            v-if="!validDoc"
          >
            Documento repetido
          </span>
          <span class="mt-2 text-base leading-normal" v-else>
            Selecione o arquivo
          </span>
          <input
            id="contrato_social"
            name="contrato_social"
            type="file"
            class="hidden"
            ref="file"
            @change="fileHandler"
          />
        </label>
      </div>

      <div class="lg:ml-5 md:ml-5 self-center">
        <span class="text-base leading-normal">
          {{ file.name }}
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      file: "",
      validDoc: true,
    };
  },
  computed: {
    ...mapGetters(["solicitacao"]),
  },
  methods: {
    fileHandler() {
      this.file = this.$refs.file.files[0];
      this.validDoc = this.validDocument();
      if (this.validDoc) this.$store.commit("SET_DOC_FILES", this.file);
    },
    validDocument() {
      let index = this.$store.state.solicitacao.docs.findIndex(
        (item) => item.name == this.file.name
      );
      if (index >= 0) return false;
      return true;
    },
  },
};
</script>

<style>
</style>