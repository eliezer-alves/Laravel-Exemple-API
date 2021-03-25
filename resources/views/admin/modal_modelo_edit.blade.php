<form action="#" method="POST" class="flex flex-wrap p-4 h-full items-center">

    <!--Overlay-->
    <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
        <!--Dialog-->
        <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">

            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Editar Modelo</p>
                <div class="cursor-pointer z-50" @click="showModal = false">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>

            <!-- content -->
            <div class="my-1 text-sm">
                <label for="id_modelo_sicred" class="block text-black">Modelo ID</label>
                <input type="text" id="id_modelo_sicred" name="id_modelo_sicred" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="" />
            </div>
            <div class="my-1 text-sm">
                <label for="modelo" class="block text-black">Modelo</label>
                <input type="text" id="modelo" name="modelo" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="" />
            </div>
            <div class="my-1 text-sm">
                <label for="empresa" class="block text-black">Empresa</label>
                <input type="text" id="empresa" name="empresa" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="" />
            </div>
            <div class="my-1 text-sm">
                <label for="agencia" class="block text-black">Agência</label>
                <input type="text" id="agencia" name="agencia" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="" />
            </div>
            <div class="my-1 text-sm">
                <label for="loja" class="block text-black">Loja</label>
                <input type="text" id="loja" name="loja" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="" />
            </div>
            <div class="my-1 text-sm">
                <label for="lojista" class="block text-black">Lojista</label>
                <input type="text" id="lojista" name="lojista" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="" />
            </div>
            <div class="my-1 text-sm">
                <label for="produto" class="block text-black">Produto</label>
                <input type="text" id="produto" name="produto" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="" />
            </div>
            <div class="grid grid-cols-2">
                <div class="my-1 text-sm col-span-1 mr-2">
                    <label for="plano" class="block text-black">Plano</label>
                    <input type="text" id="plano" name="plano" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="" />
                </div>
                <div class="my-1 text-sm col-span-1">
                    <label for="taxa" class="block text-black">Taxa</label>
                    <input type="text" id="taxa" name="taxa" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="" />
                </div>
            </div>
            <!--Footer-->
            <div class="flex justify-end pt-2 ml-2">
                <button class="px-4 bg-indigo-600 p-3 rounded-lg text-white  hover:bg-indigo-700 mr-2" id="btn_salvar_modelo_sicred" type="submit">Salvar</button>
                <button class="modal-close px-4  bg-transparent p-3 rounded-lg  text-indigo-600 hover:text-indigo-400" @click.prevent="showModal = false" onclick="clearModalForm()">Cancelar</button>
            </div>
        </div>
        <!--/Dialog -->
    </div>
    <!-- /Overlay -->

</form>
<script>
    function editModeloSicred(value) {
        document.querySelector('#btn_salvar_modelo_sicred').innerHTML = 'Salvar';
        document.querySelector('#id_modelo_sicred').value = clients[value]['id_modelo_sicred'];
        document.querySelector('#modelo').value = clients[value]['modelo'];
        document.querySelector('#empresa').value = clients[value]['empresa'];
        document.querySelector('#agencia').value = clients[value]['agencia'];
        document.querySelector('#loja').value = clients[value]['loja'];
        document.querySelector('#lojista').value = clients[value]['lojista'];
        document.querySelector('#produto').value = clients[value]['produto'];
        document.querySelector('#plano').value = clients[value]['plano'];
        document.querySelector('#taxa').value = clients[value]['taxa'];
    }

    function createModeloSicred() {
        clearModalForm();
        document.querySelector('#btn_salvar_modelo_sicred').innerHTML = 'Cadastrar';
    }

    function clearModalForm() {
        document.querySelector('#id_modelo_sicred').value = '';
        document.querySelector('#modelo').value = '';
        document.querySelector('#empresa').value = '';
        document.querySelector('#agencia').value = '';
        document.querySelector('#loja').value = '';
        document.querySelector('#lojista').value = '';
        document.querySelector('#produto').value = '';
        document.querySelector('#plano').value = '';
        document.querySelector('#taxa').value = '';
    }
</script>