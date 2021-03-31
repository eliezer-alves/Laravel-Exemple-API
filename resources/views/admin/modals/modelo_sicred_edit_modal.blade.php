<form x-ref="form_modelo" :action="actionEditForm" method="POST" class="flex flex-wrap p-4 h-full items-center">
    @csrf
    <!--Overlay-->
    <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showEditModal" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showEditModal }">
        <!--Dialog-->
        <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" @click.away="close()" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">

            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Editar Modelo</p>
                <div class="cursor-pointer z-50" @click="close()">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>

            <!-- content -->
            <div class="my-1 text-sm" hidden="">
                <label for="id_registro" class="block text-black">ID Registro <span class="text-indigo-500">*</span></label>
                <input type="text" id="id_registro" name="id_registro" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="" x-ref="id_registro" />
            </div>

            <div class="my-5 text-sm">
                <label for="modelo" class="block text-black">Modelo <span class="text-indigo-500">*</span></label>
                <input type="text" id="modelo" name="modelo" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('modelo') }}" x-ref="modelo" />
                @error('modelo')
                <template class="mb-2" x-if="showValidationErrors">
                    <div class="text-red-600">{{ $message }}</div>
                </template>
                @enderror
            </div>


            <div class="my-5 grid grid-cols-2">
                <div class="text-sm col-span-1 mr-1">
                    <label for="empresa" class="block text-black">Empresa <span class="text-indigo-500">*</span></label>
                    <input type="text" id="empresa" name="empresa" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('empresa') }}" x-ref="empresa" />
                    @error('empresa')
                    <template class="mb-2" x-if="showValidationErrors">
                        <div class="text-red-600">{{ $message }}</div>
                    </template>
                    @enderror
                </div>

                <div class="text-sm col-span-1 ml-1">
                    <label for="agencia" class="block text-black">Agência <span class="text-indigo-500">*</span></label>
                    <input type="text" id="agencia" name="agencia" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('agencia') }}" x-ref="agencia" />
                    @error('agencia')
                    <template class="mb-2" x-if="showValidationErrors">
                        <div class="text-red-600">{{ $message }}</div>
                    </template>
                    @enderror
                </div>
            </div>

            <div class="my-5 grid grid-cols-2">
                <div class="text-sm col-span-1 mr-1">
                    <label for="loja" class="block text-black">Loja <span class="text-indigo-500">*</span></label>
                    <input type="text" id="loja" name="loja" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('loja') }}" x-ref="loja" />
                    @error('loja')
                    <template class="mb-2" x-if="showValidationErrors">
                        <div class="text-red-600">{{ $message }}</div>
                    </template>
                    @enderror
                </div>

                <div class="text-sm col-span-1 ml-1">
                    <label for="lojista" class="block text-black">Lojista <span class="text-indigo-500">*</span></label>
                    <input type="text" id="lojista" name="lojista" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('lojista') }}" x-ref="lojista" />
                    @error('lojista')
                    <template class="mb-2 text-red-600" x-if="showValidationErrors">
                        <div class="text-red-600">{{ $message }}</div>
                    </template>
                    @enderror
                </div>
            </div>

            <div class="my-5 text-sm">
                <label for="cosif" class="block text-black">Cosif <span class="text-indigo-500">*</span></label>
                <input type="text" id="cosif" name="cosif" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('cosif') }}" x-ref="cosif" />
                @error('cosif')
                <template class="mb-2 text-red-600" x-if="showValidationErrors">
                    <div class="text-red-600">{{ $message }}</div>
                </template>
                @enderror
            </div>

            <div class="my-5 text-sm">
                <label for="produto" class="block text-black">Produto <span class="text-indigo-500">*</span></label>
                <input type="text" id="produto" name="produto" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('produto') }}" x-ref="produto" />
                @error('produto')
                <template class="mb-2 text-red-600" x-if="showValidationErrors">
                    <div class="text-red-600">{{ $message }}</div>
                </template>
                @enderror
            </div>

            <div class="my-5 grid grid-cols-2">
                <div class="text-sm col-span-1 mr-1">
                    <label for="plano" class="block text-black">Plano <span class="text-indigo-500">*</span></label>
                    <input type="text" id="plano" name="plano" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('plano') }}" x-ref="plano" />
                    @error('plano')
                    <template class="mb-2" x-if="showValidationErrors">
                        <div class="text-red-600">{{ $message }}</div>
                    </template>
                    @enderror
                </div>

                <div class="text-sm col-span-1 ml-1">
                    <label for="taxa" class="block text-black">Taxa <span class="text-indigo-500">*</span></label>
                    <input type="number" id="taxa" name="taxa" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" step="0.01" value="{{ old('taxa') }}" x-ref="taxa" />
                    @error('taxa')
                    <template class="mb-2" x-if="showValidationErrors">
                        <div class="text-red-600">{{ $message }}</div>
                    </template>
                    @enderror
                </div>
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
