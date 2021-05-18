<form x-show="showUrlModeloSicredModal" x-ref="form_ur_modelo" :action="actionEditFormUrlModelo" method="POST" class="flex flex-wrap p-4 h-full items-center">
    @csrf
    <!--Overlay-->
    <di class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showUrlModeloSicredModal }">
        <!--Dialog-->
        <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" @click.away="close()" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">

            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">URL's Ativas do Modelo</p>
                <div class="cursor-pointer z-50" @click="close()">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>

            <!-- content -->
            <div class=" p-2 grid grid-cols-2 gap-2 text-sm">

                @foreach ($urls as $url)
                <!-- Toggle -->
                <div class="toggleButton flex flex-col justify-items-start w-full my-4">
                    <label for="toggle_{{ $url['id_url_sicred'] }}" class="flex items-center cursor-pointer">
                        <!-- toggle -->
                        <div class="relative">
                        <!-- input -->
                        <input type="checkbox" id="toggle_{{ $url['id_url_sicred'] }}" name="url[]" value="{{ $url['id_url_sicred'] }}" class="sr-only">
                        <!-- line -->
                        <div class="block bg-gray-300 w-14 h-8 rounded-full"></div>
                        <!-- dot -->
                        <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                        </div>
                        <!-- label -->
                        <div class="ml-3 text-gray-700 font-semibold">
                        {{ $url["servico"] }}
                        </div>
                    </label>                    
                    <span class="mt-3 text-gray-500 font-light">{{ $url["url"] }}</span>
                </div>
                @endforeach

            </div>

            <!--Footer-->
            <div class="flex justify-end pt-2 ml-2">
                <!-- <button type="button" class="modal-close px-4  bg-indigo-600 p-3 rounded-lg text-white hover:text-indigo-400" @click.prevent="close()">OK</button> -->
                <button class="px-4 bg-indigo-600 p-3 rounded-lg text-white  hover:bg-indigo-700 mr-2" id="btn_modal_salvar" type="submit" x-ref="bnt_salvar">Salvar</button>
                <button class="modal-close px-4  bg-transparent p-3 rounded-lg  text-indigo-600 hover:text-indigo-400" @click.prevent="close()">Cancelar</button>
            </div>
        </div>
        <!--/Dialog -->
    </div>
    <!-- /Overlay -->
    </form>
