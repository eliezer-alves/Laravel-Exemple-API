<template>
  <!-- component -->
  <!-- This is an example component -->
  <div class="h-screen w-screen bg-gray-100 flex items-center">
    <div
      class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700"
    >
      <div class="max-w-md">
        <div class="text-5xl font-dark font-bold">404</div>
        <p class="text-2xl md:text-3xl font-light leading-normal">
          Desculpe, não encontramos esta página.
        </p>
        <p class="mb-8">Retorne para nossa página principal.</p>
        <router-link :to="{ name: 'login' }">
          <button
            class="px-4 inline py-2 text-sm font-medium leading-5 shadow text-white transition-colors duration-150 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-green bg-green-600 active:bg-green-600 hover:bg-green-700"
          >
            Retornar para o login
          </button>
        </router-link>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>
<style>
</style>
