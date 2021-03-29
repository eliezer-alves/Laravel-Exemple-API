<section class="flex flex-wrap p-4 h-full items-center">
  <!--Overlay-->
  <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
    <!--Dialog-->
    <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">

      <!--Title-->
      <div class="flex justify-between items-center pb-3">
        <p class="text-2xl font-bold">Editor</p>
        <div class="cursor-pointer z-50" @click="showModal = false">
          <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
        </div>
      </div>

      <!-- content -->
      <form action="" class="mt-1">
        <div class="grid md:grid-cols-2 gap-2">
          <div class="my-5 text-sm">
            <label for="environment" class="block text-black">Environment</label>
            <input type="text" autofocus id="environment" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="Ambiente" value="" />
          </div>
          <div class="my-5 text-sm">
            <label for="grant_type" class="block text-black">Grant Type</label>
            <input type="text" id="grant_type" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="Grant Type" value="" />
          </div>
        </div>
        <div class="grid md:grid-cols-2 gap-2">
          <div class="my-5 text-sm">
            <label for="username" class="block text-black">Username</label>
            <input type="text" id="username" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="Username" value="" />
          </div>
          <div class="my-5 text-sm">
            <label for="password" class="block text-black">Password</label>
            <input type="text" id="password" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="Password" value="" />
          </div>
        </div>

        <div class="my-5 text-sm">
          <label for="client_id" class="block text-black">Client ID</label>
          <input type="text" id="client_id" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="Client ID" value="" />
        </div>
        <div class="my-5 text-sm">
          <label for="client_secret" class="block text-black">Client Secret</label>
          <input type="text" id="client_secret" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="Client Secret" value="" />
        </div>
        <div class="my-5 text-sm">
          <label for="scope" class="block text-black">Scope</label>
          <input type="text" id="scope" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="Escopo" value="" />
        </div>

        <!--Footer-->
        <div class="flex justify-end pt-2">
          <button class="px-4 bg-indigo-600 p-3 rounded-lg text-white hover:bg-gray-100  hover:bg-indigo-700 mr-2 btn_salvar_client_sicred" @click="">Salvar</button>
          <button class="modal-close px-4  bg-transparent p-3 rounded-lg  text-indigo-600 hover:text-indigo-400 " @click="showModal = false" onclick="clearModalForm()">Cancelar</button>
        </div>


    </div>
    <!--/Dialog -->
  </div><!-- /Overlay -->

</section>

<script>
  function editClientSicred(value) {
    document.querySelector('.btn_salvar_client_sicred').innerHTML = 'Salvar'
    document.querySelector('#environment').value = clients[value]['environment'];
    document.querySelector('#grant_type').value = clients[value]['grant_type'];
    document.querySelector('#username').value = clients[value]['username'];
    document.querySelector('#password').value = clients[value]['password'];
    document.querySelector('#client_id').value = clients[value]['client_id'];
    document.querySelector('#client_secret').value = clients[value]['client_secret'];
    document.querySelector('#scope').value = clients[value]['scope'];
  }

  function createClientSicred() {
    clearModalForm();
    document.querySelector('.btn_salvar_client_sicred').innerHTML = 'Cadastrar';
  }

  function clearModalForm() {
    document.querySelector('#environment').value = ''
    document.querySelector('#grant_type').value = ''
    document.querySelector('#username').value = ''
    document.querySelector('#password').value = ''
    document.querySelector('#client_id').value = ''
    document.querySelector('#client_secret').value = ''
    document.querySelector('#scope').value = ''
  }
</script>
