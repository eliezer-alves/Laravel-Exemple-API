<form x-show="showEditModal" x-ref="form_url" :action="actionEditForm" method="POST" class="flex flex-wrap p-4 h-full items-center">
    @csrf
    <!--Overlay-->
    <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showEditModal }">
        <!--Dialog-->
        <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" @click.away="close()" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">

            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Editar URL Serviço</p>
                <div class="cursor-pointer z-50" @click="close()">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>

            <!-- content -->
            <div class="my-5 text-sm">
                <label for="servico" class="block text-black">Servico <span class="text-indigo-500">*</span></label>
                <input type="text" id="servico" name="servico" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('servico') }}" x-ref="servico" />
                @error('servico')
                <template class="mb-2" x-if="showValidationErrors">
                    <div class="text-red-600">{{ $message }}</div>
                </template>
                @enderror
            </div>


            <div class="my-5 text-sm">
                <label for="url" class="block text-black">url <span class="text-indigo-500">*</span></label>
                <input type="text" id="url" name="url" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('url') }}" x-ref="url" />
                @error('url')
                <template class="mb-2" x-if="showValidationErrors">
                    <div class="text-red-600">{{ $message }}</div>
                </template>
                @enderror
            </div>

            <!--Footer-->
            <div class="flex justify-end pt-2 ml-2">
                <button class="px-4 bg-indigo-600 p-3 rounded-lg text-white  hover:bg-indigo-700 mr-2" id="btn_modal_salvar" type="submit" x-ref="bnt_salvar">Salvar</button>
                <button class="modal-close px-4  bg-transparent p-3 rounded-lg  text-indigo-600 hover:text-indigo-400" @click.prevent="close()">Cancelar</button>
            </div>
        </div>
        <!--/Dialog -->
    </div>
    <!-- /Overlay -->

</form>
