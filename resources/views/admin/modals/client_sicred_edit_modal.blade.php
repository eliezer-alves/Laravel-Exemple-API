<form id="form_eidt_client_sicred" x-ref="form_eidt_client_sicred" :action="actionEditForm" method="POST" class="flex flex-wrap p-4 h-full items-center">
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
                <input type="text" id="id_registro" name="id_registro" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="" />                
            </div>

            <div class="my-5 text-sm">
                <label for="environment" class="block text-black">Environment <span class="text-indigo-500">*</span></label>
                <input type="text" id="environment" name="environment" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('environment') }}" />
                @error('environment')
                <template class="mb-2" x-if="showValidationErrors">
                    <div class="text-red-600">{{ $message }}</div>
                </template>
                @enderror
            </div>

            <div class="my-5 text-sm">
                <label for="grant_type" class="block text-black">Grant Type <span class="text-indigo-500">*</span></label>
                <input type="text" id="grant_type" name="grant_type" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('grant_type') }}" />
                @error('grant_type')
                <template class="mb-2" x-if="showValidationErrors">
                    <div class="text-red-600">{{ $message }}</div>
                </template>
                @enderror
            </div>

            <div class="my-5 grid grid-cols-2">
                <div class="text-sm col-span-1 mr-2">
                    <label for="username" class="block text-black">Username <span class="text-indigo-500">*</span></label>
                    <input type="text" id="username" name="username" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('username') }}" />
                    @error('username')
                    <template class="mb-2" x-if="showValidationErrors">
                        <div class="text-red-600">{{ $message }}</div>
                    </template>
                    @enderror
                </div>

                <div class="text-sm col-span-1">
                    <label for="password" class="block text-black">Password <span class="text-indigo-500">*</span></label>
                    <input type="text" id="password" name="password" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('password') }}" />
                    @error('password')
                    <template class="mb-2" x-if="showValidationErrors">
                        <div class="text-red-600">{{ $message }}</div>
                    </template>
                    @enderror
                </div>
            </div>

            <div class="my-5 text-sm">
                <label for="client_id" class="block text-black">Client Id <span class="text-indigo-500">*</span></label>
                <input type="text" id="client_id" name="client_id" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('client_id') }}" />
                @error('client_id')
                <template class="mb-2 text-red-600" x-if="showValidationErrors">
                    <div class="text-red-600">{{ $message }}</div>
                </template>
                @enderror
            </div>

            <div class="my-5 text-sm">
                <label for="client_secret" class="block text-black">Client Secret <span class="text-indigo-500">*</span></label>
                <input type="text" id="client_secret" name="client_secret" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('client_secret') }}" />
                @error('client_secret')
                <template class="mb-2 text-red-600" x-if="showValidationErrors">
                    <div class="text-red-600">{{ $message }}</div>
                </template>
                @enderror
            </div>

            <div class="my-5 text-sm">
                <label for="scope" class="block text-black">Scope <span class="text-indigo-500">*</span></label>
                <input type="text" id="scope" name="scope" class="rounded-lg px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" value="{{ old('scope') }}" />
                @error('scope')
                <template class="mb-2 text-red-600" x-if="showValidationErrors">
                    <div class="text-red-600">{{ $message }}</div>
                </template>
                @enderror
            </div>

            <!--Footer-->
            <div class="flex justify-end pt-2 ml-2">
                <button class="px-4 bg-indigo-600 p-3 rounded-lg text-white  hover:bg-indigo-700 mr-2" id="btn_modal_salvar" type="submit">Salvar</button>
                <button class="modal-close px-4  bg-transparent p-3 rounded-lg  text-indigo-600 hover:text-indigo-400" @click.prevent="close()">Cancelar</button>
            </div>
        </div>
        <!--/Dialog -->
    </div>
    <!-- /Overlay -->

</form>