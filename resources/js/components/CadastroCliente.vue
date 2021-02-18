<template>
  <!-- component -->
  <div class="lg:w-4/12 md:6/12 w-10/12 m-auto">
    <!-- component -->

    <div class="container max-w-full mx-auto py-16 px-6">
      <div class="font-sans">
        <div class="max-w-sm mx-auto px-6">
          <div class="relative flex flex-wrap">
            <div class="w-full relative">
              <div class="mt-6">
                <div class="text-center text-xl font-semibold text-black">
                  Painel Administrador
                </div>

                <form class="mt-8">
                  <div class="mx-auto max-w-lg">
                    <div class="py-2">
                      <span class="px-1 text-sm text-gray-600">Usuário</span>
                      <input
                        placeholder=""
                        type="text"
                        class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
                      />
                    </div>
                    <div class="py-2">
                      <span class="px-1 text-sm text-gray-600">Senha</span>
                      <div class="relative">
                        <input
                          placeholder=""
                          class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
                        />
                      </div>
                    </div>
                    <div class="flex justify-between">
                      <!-- <label class="block text-gray-500 font-bold my-4"
                        ><input
                          type="checkbox"
                          class="leading-loose text-pink-600"
                        />
                        <span class="py-2 text-sm text-gray-600 leading-snug">
                          Remember Me
                        </span>
                      </label> -->
                      <label class="block text-gray-500 font-bold my-4">
                        <a
                          href="#"
                          class="cursor-pointer self-center tracking-tighter text-black border-b-2 border-gray-200 hover:border-gray-400"
                          ><span>Esqueci minha senha</span>
                        </a>
                      </label>
                    </div>
                    <button
                      class="mt-3 text-lg font-semibold bg-gray-800 w-full text-white rounded-lg px-6 py-3 block shadow-xl hover:text-white hover:bg-black"
                    >
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  beforeCreate: function () {
    document.body.className = "login-admin";
  },
};
</script>
<style>
.login-admin {
  -webkit-font-smoothing: antialiased;
  background-image: none;
  background-color: #cecece;
}
</style>
