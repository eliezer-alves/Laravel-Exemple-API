<template>
  <div
    class="flex flex-col font-bold text-gray-600 text-xs leading-8 uppercase mx-2 mt-3"
  >
    <div class="flex justify-around">
      <div class="">
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
          <span class="mt-2 text-base leading-normal" v-if="!this.file">
            Selecione o arquivo
          </span>
          <span
            class="mt-2 text-base text-yellow-500 leading-normal"
            v-else-if="!valid"
          >
            Documento repetido
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

      <div>
        <svg
          @click="removeDoc"
          class="cursor-pointer text-red-600 hover:text-red-800 self-center"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="currentColor"
          width="50"
          height="50"
        >
          <path
            fill-rule="evenodd"
            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm1 8a1 1 0 100 2h6a1 1 0 100-2H7z"
            clip-rule="evenodd"
          />
        </svg>
      </div>
    </div>
    <div class="lg:ml-5 md:ml-5 self-center">
      <span class="text-base leading-normal">
        {{ file.name }}
      </span>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  props: ["id"],
  data() {
    return {
      file: "",
      valid: false,
    };
  },
  computed: {
    ...mapGetters(["solicitacao"]),
  },
  methods: {
    fileHandler() {
      this.file = this.$refs.file.files[0];
      this.validDocument();
      const index = this.solicitacao.docs.findIndex(
        (doc) => doc.id === this.id
      );
      if (this.valid) {
        this.solicitacao.docs[index].file = this.file;
      }
      this.solicitacao.docs[index].valid = this.valid;
    },
    validDocument() {
      const doc_index = this.$store.state.solicitacao.docs.findIndex(
        (item) => item.file.name == this.file.name
      );
      if (doc_index >= 0) {
        const doc_rep_index = this.$store.state.solicitacao.docs
          .map((e) => {
            return e.file.name;
          })
          .indexOf(this.file.name, doc_index);
        this.valid = false;
      } else this.valid = true;
    },
    removeDoc() {
      this.$emit("remove", this.id);
    },
  },
};
</script>

<style>
</style>