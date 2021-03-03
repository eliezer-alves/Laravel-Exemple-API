<template>
  <!-- <side-bar> -->
  <div class="container lg:w-8/12 mx-auto mt-16">
    <div class="flex">
      <div class="w-1/4">
        <div class="relative mb-2">
          <div
            class="w-10 h-10 mx-auto bg-white rounded-full text-lg text-white flex items-center"
            :class="{
              'bg-teal-700': $router.currentRoute.name === 'solicitacao',
            }"
          >
            <span class="text-center text-gray-700 w-full">
              <svg
                class="w-full"
                :class="{
                  'text-white': $router.currentRoute.name === 'solicitacao',
                }"
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
                :class="{
                  'w-full':
                    $router.currentRoute.name === 'solicitacao-2' ||
                    $router.currentRoute.name === 'solicitacao-3' ||
                    $router.currentRoute.name === 'solicitacao-4',
                }"
              ></div>
            </div>
          </div>

          <div
            class="w-10 h-10 mx-auto bg-white rounded-full text-lg text-white flex items-center"
            :class="{
              'bg-teal-700': $router.currentRoute.name === 'solicitacao-2',
            }"
          >
            <span class="text-center text-gray-700 w-full">
              <svg
                class="w-full"
                :class="{
                  'text-white': $router.currentRoute.name === 'solicitacao-2',
                }"
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
                :class="{
                  'w-full':
                    $router.currentRoute.name === 'solicitacao-3' ||
                    $router.currentRoute.name === 'solicitacao-4',
                }"
              ></div>
            </div>
          </div>

          <div
            class="w-10 h-10 mx-auto bg-white rounded-full text-lg text-white flex items-center"
            :class="{
              'bg-teal-700': $router.currentRoute.name === 'solicitacao-3',
            }"
          >
            <span class="text-center text-gray-700 w-full">
              <svg
                class="w-full"
                :class="{
                  'text-white': $router.currentRoute.name === 'solicitacao-3',
                }"
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
                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
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
              <div
                class="w-0 bg-teal-500 py-1 rounded"
                :class="{
                  'w-full': $router.currentRoute.name === 'solicitacao-4',
                }"
              ></div>
            </div>
          </div>

          <div
            class="w-10 h-10 mx-auto bg-white rounded-full text-lg text-white flex items-center"
            :class="{
              'bg-teal-700': $router.currentRoute.name === 'solicitacao-4',
            }"
          >
            <span class="text-center text-gray-700 w-full">
              <svg
                class="w-full"
                :class="{
                  'text-white': $router.currentRoute.name === 'solicitacao-4',
                }"
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
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
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