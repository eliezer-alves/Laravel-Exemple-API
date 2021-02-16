<template>
  <div class="w-full h-screen">
    <header class="bg-teal-400">
      <nav class="flex justify-between w-full bg-purple-500 text-white p-4">
        <a href="/"
          ><span class="font-semibold text-xl tracking-tight">Title</span></a
        >
        <div class="md:items-center md:w-auto flex">
          <div class="md:flex hidden">
            <a class="block md:text-white mr-4" href="/link">Link 1</a>
            <a class="block md:text-white mr-4" href="/link">Link 2</a>
            <a class="block md:text-white mr-4" href="/link">Link 3</a>
            <a class="block md:text-white mr-4" href="/link">Link 4</a>
          </div>
          <div class="flex text-sm">
            <a
              class="p-2 ml-2 bg-white text-teal-500 font-semibold leading-none border border-gray-100 rounded hover:border-transparent hover:bg-gray-100"
              href="/auth/signin"
              >Login</a
            >
            <a
              class="p-2 ml-2 bg-teal-500 text-gray-100 font-semibold leading-none border border-teal-600 rounded hover:border-transparent hover:bg-teal-600"
              href="/auth/signup"
              >Sign up</a
            >
          </div>
        </div>
      </nav>
    </header>
  </div>
</template>
<script>
export default {
  created: function () {
    console.log('aqui');
  }
};
</script>
<style>
</style>
