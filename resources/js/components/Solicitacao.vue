<template>
  <!-- <side-bar> -->
  <div class="container lg:w-8/12 mx-auto mt-16">
    <div class="flex">
      <div class="w-1/4">
        <div class="relative mb-2">
          <div
            class="w-10 h-10 mx-auto rounded-full bg-teal-700 text-white text-lg flex items-center"
          >
            <span class="text-center text-white w-full">
              <svg
                class="w-full"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                width="24"
                height="24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"
                />
              </svg>
            </span>
          </div>
        </div>

        <div class="text-xs text-center md:text-base">Simulação</div>
      </div>

      <div class="w-1/4">
        <div class="relative mb-2">
          <div
            class="absolute flex align-center items-center align-middle content-center"
            style="
              width: calc(100% - 2.5rem - 1rem);
              top: 50%;
              transform: translate(-50%, -50%);
            "
          >
            <div
              class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1"
            >
              <div
                class="w-0 bg-teal-500 py-1 rounded"
                style="width: 100%"
              ></div>
            </div>
          </div>

          <div
            class="w-10 h-10 mx-auto rounded-full bg-white text-lg flex items-center"
            :class="{
              'bg-teal-700': [
                $router.currentRoute.name === 'solicitacao-2',
                $router.currentRoute.name === 'solicitacao-3',
                $router.currentRoute.name === 'solicitacao-4',
              ],
              'text-white': [
                $router.currentRoute.name === 'solicitacao-2',
                $router.currentRoute.name === 'solicitacao-3',
                $router.currentRoute.name === 'solicitacao-4',
              ],
            }"
          >
            <span
              class="text-center text-gray-700 w-full"
              :class="{
                'text-white': [
                  $router.currentRoute.name === 'solicitacao-2',
                  $router.currentRoute.name === 'solicitacao-3',
                  $router.currentRoute.name === 'solicitacao-4',
                ],
              }"
            >
              <svg
                class="w-full"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                width="24"
                height="24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                />
              </svg>
            </span>
          </div>
        </div>

        <div class="text-xs text-center md:text-base">Empresa</div>
      </div>

      <div class="w-1/4">
        <div class="relative mb-2">
          <div
            class="absolute flex align-center items-center align-middle content-center"
            style="
              width: calc(100% - 2.5rem - 1rem);
              top: 50%;
              transform: translate(-50%, -50%);
            "
          >
            <div
              class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1"
            >
              <div
                class="w-0 bg-teal-500 py-1 rounded"
                style="width: 33%"
              ></div>
            </div>
          </div>

          <div
            class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center"
            :class="{
              'bg-teal-700': $router.currentRoute.name === 'solicitacao-3',
            }"
          >
            <span class="text-center text-gray-600 w-full">
              <svg
                class="w-full fill-current"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="24"
                height="24"
              >
                <path
                  class="heroicon-ui"
                  d="M19 10h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2h-2a1 1 0 0 1 0-2h2V8a1 1 0 0 1 2 0v2zM9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h5a5 5 0 0 1 5 5v2z"
                />
              </svg>
            </span>
          </div>
        </div>

        <div class="text-xs text-center md:text-base">Representantes</div>
      </div>

      <div class="w-1/4">
        <div class="relative mb-2">
          <div
            class="absolute flex align-center items-center align-middle content-center"
            style="
              width: calc(100% - 2.5rem - 1rem);
              top: 50%;
              transform: translate(-50%, -50%);
            "
          >
            <div
              class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1"
            >
              <div class="w-0 bg-teal-500 py-1 rounded" style="width: 0%"></div>
            </div>
          </div>

          <div
            class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center"
            :class="{
              'bg-teal-700': $router.currentRoute.name === 'solicitacao-4',
              'bg-teal-700': $router.currentRoute.name === 'solicitacao-4',
            }"
          >
            <span class="text-center text-gray-600 w-full">
              <svg
                class="w-full fill-current"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="24"
                height="24"
              >
                <path
                  class="heroicon-ui"
                  d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"
                />
              </svg>
            </span>
          </div>
        </div>

        <div class="text-xs text-center md:text-base">Concluir</div>
      </div>
    </div>
    <slot></slot>
  </div>
  <!-- </side-bar> -->
</template>
<script>
import SideBar from "./SideBar.vue";

export default {
  components: {
    SideBar,
  },
};
</script>
<style>
.form {
  background-color: #00b4b4;
}
</style>  