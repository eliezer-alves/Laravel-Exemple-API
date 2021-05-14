@extends('admin.index')

@section('content')
<div class="h-full" x-data="handleModals({{ $errors }})" x-cloak>
    <div class="h-full my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="h-full align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="h-2/12 flex flex-row-reverse items-center">
                <button type="button" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full mb-4" @click="openStore()" value="">Cadastrar</button>
            </div>
            <div class="h-11/12 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="h-full flex flex-col min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr class="flex w-full">
                            <th scope="col" class="w-4/12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Serviço
                            </th>
                            <th scope="col" class="w-6/12 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                URL
                            </th>
                            <th scope="col" class="w-1/12 px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                            </th>
                            <th scope="col" class="w-1/12 px-6 py-3">
                                <span class="sr-only">Delete</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="flex flex-col overflow-y-scroll scrollbar-eli bg-white divide-y divide-gray-200">

                        @foreach ($urls as $key => $url)
                        <tr class="h-full">
                            <td class="w-4/12 px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $url['servico'] }}
                            </td>
                            <td class="w-6/12 px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $url['url'] }}
                            </td>
                            <td class="w-1/12 px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button type="button" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full" @click="openUpdate({{ json_encode($url) }}, {{ $url['id_url_sicred'] }})">Editar</button>
                            </td>
                            <td class="w-1/12 px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button type="button" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full" @click="openDelete({{ $url['id_url_sicred'] }})">Excluir</button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.modals.url_sicred_edit_modal')
    @include('admin.modals.confirm_delete_modal')
</div>

<script>
    function handleModals(errors) {
        return {
            showValidationErrors: (!!errors && Object.keys(errors).length > 0),
            showEditModal: (!!errors && Object.keys(errors).length > 0),
            showDeleteModal: false,
            actionEditForm: '#',
            actionDeleteForm: '#',
            openStore() {
                this.showEditModal = true;
                this.actionEditForm = `@php echo route('admin.url-sicred.store') @endphp`;
                this.clearForm();
                this.$refs.bnt_salvar.innerText = 'Cadastrar';
            },
            openUpdate(data, id) {
                console.log(id);
                this.showEditModal = true;
                this.showValidationErrors = false;
                this.actionEditForm = `@php echo route('admin.url-sicred.update', '') @endphp/${id}`;
                this.setDataUpdate(data);
            },
            openDelete(id) {
                this.showDeleteModal = true;
                this.actionDeleteForm = `@php echo route('admin.url-sicred.destroy', '') @endphp/${id}`;
            },
            close() {
                this.showEditModal = false;
                this.showDeleteModal = false;
            },
            isOpen() {
                return this.showEditModal === true;
            },
            clearForm() {
                this.$refs.form_url.reset();
            },
            setDataUpdate(data) {
                console.log(data);
                this.$refs.bnt_salvar.innerText = 'Editar';
                this.$refs.servico.value = data.servico;
                this.$refs.url.value = data.url;
            }
        };
    }
</script>


@endsection
