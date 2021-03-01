<template>
  <div
    class="flex lg:flex-row md:flex-row flex-col font-bold text-gray-600 text-xs leading-8 uppercase mx-2 mt-3"
  >
    <div class="self-center">
      <label
        class="w-56 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-teal-800 cursor-pointer hover:bg-teal-800 hover:text-white"
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
        <span class="mt-2 text-base leading-normal">Selecione o arquivo</span>
        <input type="file" class="hidden" />
      </label>
    </div>

    <div class="lg:ml-5 md:ml-5 self-center">
      <span class="text-base leading-normal">
        Nome do Arquivo Selecionado
      </span>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>