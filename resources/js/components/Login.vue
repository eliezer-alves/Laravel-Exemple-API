<template>
  <!-- component -->
  <div class="lg:w-4/12 md:6/12 w-10/12 m-auto my-10">
    <div class="py-8 px-8 rounded-xl">
      <img
        class="mx-auto w-72"
        src="/images/logoAgilVertical.png"
        alt="Workflow"
      />

      <form action="/solicitar" class="mt-2 mx-auto w-72">
        <div class="mt-1 text-sm">
          <input
            type="text"
            autofocus
            id="username"
            class="rounded-sm px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full"
            placeholder="Usuário"
          />
        </div>
        <div class="mt-1 text-sm">
          <input
            type="password"
            id="password"
            class="rounded-sm px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full"
            placeholder="Senha"
          />
          <div class="flex justify-end mt-2 text-xs text-gray-600">
            <a href="../../pages/auth/forget_password.html hover:text-black"
              >Esqueceu a senha?</a
            >
          </div>
        </div>

        <!--  <button
                    class="block w-full text-center text-green-900 text-lg font-bold bg-gradient-to-r from-green-600 to-yellow-300 hover:bg-gradient-to-l hover:from-yellow-300 hover:to-green-600 p-3 rounded-md hover:bg-black "
                >
                    Log In
                </button> -->
        <router-link
          class="block relative h-48 rounded overflow-hidden"
          :to="{ name: 'home' }"
        >
          <a
            class="block w-full text-center text-green-900 text-lg font-bold bg-gradient-to-r from-green-600 to-yellow-300 hover:bg-gradient-to-l hover:from-yellow-300 hover:to-green-600 p-3 rounded-md hover:bg-black"
            >Log In</a
          >
        </router-link>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  beforeCreate: function () {
    document.body.className = "login";
  },
};
</script>
<style>
.login {
  background-image: url("/images/texturaBackgroundAgil.png");
  background-color: #30615f;
  background-size: 900px;
}
</style>
