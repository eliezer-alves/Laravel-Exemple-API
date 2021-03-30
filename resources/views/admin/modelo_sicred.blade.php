@extends('admin.index')

@section('content')
<style>
    [x-cloak] {
        display: none;
    }

    .duration-300 {
        transition-duration: 300ms;
    }

    .ease-in {
        transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
    }

    .ease-out {
        transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
    }

    .scale-90 {
        transform: scale(.9);
    }

    .scale-100 {
        transform: scale(1);
    }
</style>
<div class="flex flex-col" x-data="handleModals({{ $errors }})" x-cloak>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="flex flex-row-reverse">
                <button type="button" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full mb-4" @click="openStore()" value="">Cadastrar</button>
            </div>
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Modelo
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Empresa
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Agencia
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Loja
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Lojista
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Produto
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Plano
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Taxa
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Delete</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($modelos as $key => $modelo)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $modelo['modelo'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $modelo['empresa'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $modelo['agencia'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $modelo['loja'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $modelo['lojista'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $modelo['produto'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $modelo['plano'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $modelo['taxa'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button type="button" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full" @click="openUpdate({{ json_encode($modelo) }})">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button type="button" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full" @click="openDelete({{ $modelo['id_modelo_sicred'] }})">Excluir</button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.modals.modelo_sicred_edit_modal')
    @include('admin.modals.confirm_delete_modal')
</div>

<script>
    function handleModals(errors)
    {
        return {
            showValidationErrors: (!!errors && Object.keys(errors).length > 0),
            showEditModal: (!!errors && Object.keys(errors).length > 0),
            showDeleteModal: false,
            actionEditForm: '#',
            actionDeleteForm: '#',
            openStore() {
                this.showEditModal = true;
                this.actionEditForm = '@php echo route('admin.modelo-sicred.store') @endphp';
                prepareFormCreate();
            },
            openUpdate(data) {
                this.showEditModal = true;
                this.showValidationErrors = false;
                this.actionEditForm = '@php echo route('admin.modelo-sicred.update', '') @endphp' + '/' + data.id_modelo_sicred;
                prepareFormUpdate(data)
            },
            openDelete(id) {
                this.showDeleteModal = true;
                this.actionDeleteForm = '@php echo route('admin.modelo-sicred.destroy', '') @endphp' + '/' + id;
            },
            close() {
                this.showEditModal = false;
                this.showDeleteModal = false;
            },
            isOpen() {
                return this.showEditModal === true;
            },
        };
    }

    function prepareFormCreate()
    {
        if(document.querySelector('#id_registro').value.length > 0){
            document.querySelector("#form_eidt_modelo_sicred").reset();
        }
        document.querySelector('#btn_modal_salvar').innerHTML = 'Cadastrar';
    }

    function prepareFormUpdate(data)
    {
        document.querySelector('#btn_modal_salvar').innerHTML = 'Salvar';
        document.querySelector('#id_registro').value = data.id_modelo_sicred
        document.querySelector('#modelo').value = data.modelo
        document.querySelector('#empresa').value = data.empresa
        document.querySelector('#agencia').value = data.agencia
        document.querySelector('#loja').value = data.loja
        document.querySelector('#lojista').value = data.lojista
        document.querySelector('#produto').value = data.produto
        document.querySelector('#plano').value = data.plano
        document.querySelector('#taxa').value = data.taxa
    }
</script>


@endsection