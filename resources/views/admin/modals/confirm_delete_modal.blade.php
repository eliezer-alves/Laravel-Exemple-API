<form x-show="showDeleteModal" id="form_delete" x-ref="form_delete" :action="actionDeleteForm" method="GET" class="flex flex-wrap p-4 h-full items-center">
    @csrf
    <!--Overlay-->
    <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showDeleteModal }">
        <!--Dialog-->
        <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" @click.away="close()" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">

            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Excluir Modelo</p>
                <div class="cursor-pointer z-50" @click="close()">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>

            <!-- content -->
            <div class="my-1 text-sm">
                <div class="mt5 mb-10 bg-red-100 border-l-4 border-red-300 rounded-md w-full px-6 py-4 cursor-pointer">Você realmente deseja excluir esse registro permanentemente?</div>
            </div>

            <!--Footer-->
            <div class="flex justify-end pt-2 ml-2">
                <button class="px-4 bg-indigo-600 p-3 rounded-lg text-white  hover:bg-indigo-700 mr-2" id="btn_excluir_modelo_sicred" type="submit">Excluir</button>
                <button class="modal-close px-4  bg-transparent p-3 rounded-lg  text-indigo-600 hover:text-indigo-400" @click.prevent="close()">Cancelar</button>
            </div>
        </div>
        <!--/Dialog -->
    </div>
    <!-- /Overlay -->
</form>
