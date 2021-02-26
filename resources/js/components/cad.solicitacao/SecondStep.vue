<template>
  <div class="p-5">
    <div class="mt-2 p-4">
      <div>
        <div class="w-full bg-teal-700 text-lg text-white pl-1 py-2 rounded-sm">
          Dados do Cliente
        </div>
        <div
          class="font-bold text-gray-600 text-xs leading-8 uppercase h-6 mx-2 mt-3"
        >
          Nome da Empresa
        </div>
        <div class="flex flex-col md:flex-row">
          <div class="w-full flex-1 mx-2">
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <input
                placeholder="Nome da Empresa"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
              />
            </div>
          </div>
          <div class="w-full flex-1 mx-2">
            <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
              <input
                placeholder="Last Name"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="flex p-2 mt-4">
        <button
          class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-gray-200 bg-gray-100 text-gray-700 border duration-200 ease-in-out border-gray-600 transition"
        >
          Previous
        </button>
        <div class="flex-auto flex flex-row-reverse">
          <button
            class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-600 bg-teal-600 text-teal-100 border duration-200 ease-in-out border-teal-600 transition"
          >
            Avançar
          </button>
          <button
            class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-teal-200 bg-teal-100 text-teal-700 border duration-200 ease-in-out border-teal-600 transition"
          >
            
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>