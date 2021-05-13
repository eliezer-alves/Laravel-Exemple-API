@extends('admin.index')

@section('content')
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col" x-data="handleModals({{ $errors }})" x-cloak>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="flex flex-row-reverse">
                <button type="button" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full my-2" @click="openStore()" value="">Cadastrar</button>
            </div>
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Environment
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Grant Type
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Password
                            </th>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Client Id
                            </th>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Client Secret
                            </th>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Scope
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
                        @foreach ($clients as $key => $client)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $client['environment'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $client['grant_type'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $client['username'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $client['password'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $client['client_id'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $client['client_secret'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $client['scope'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button type="button" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full" @click="openUpdate({{ json_encode($client) }})" x-ref="btn">Editar</button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button type="button" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full" @click="openDelete({{ $client['id_client_sicred'] }})">Excluir</button>
                            </td>
                        </tr>
                        @endforeach

                        <!-- More items... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.modals.client_sicred_edit_modal')
    @include('admin.modals.confirm_delete_modal')
</div>

<script>
    function handleModals(errors) {
        return {
            showValidationErrors: (!!errors && Object.keys(errors).length > 0),
            showEditModal: (!!errors && Object.keys(errors).length > 0),
            showDeleteModal: false,
            actionEditForm: "#",
            actionDeleteForm: "#",
            openStore() {
                this.showEditModal = true;
                this.actionEditForm = `@php echo route('admin.client-sicred.store') @endphp`;
                this.clearForm();
                this.$refs.bnt_salvar.innerText = 'Cadastrar';
            },
            openUpdate(data) {
                this.showEditModal = true;
                this.showValidationErrors = false;
                this.actionEditForm = `@php echo route('admin.client-sicred.update', '') @endphp/${data.id_client_sicred}`;
                this.setDataUpdate(data);
            },
            openDelete(id) {
                this.showDeleteModal = true;
                this.actionDeleteForm = `@php echo route('admin.client-sicred.destroy', '') @endphp/${id}`;
            },
            close() {
                this.showEditModal = false;
                this.showDeleteModal = false;
            },
            isOpen() {
                return this.showEditModal === true;
            },
            clearForm() {
                this.$refs.form_client.reset();
            },
            setDataUpdate(data) {
                this.$refs.bnt_salvar.innerText = 'Editar';
                this.$refs.id_registro.value = data.id_registro;
                this.$refs.environment.value = data.environment;
                this.$refs.grant_type.value = data.grant_type;
                this.$refs.username.value = data.username;
                this.$refs.password.value = data.password;
                this.$refs.client_id.value = data.client_id;
                this.$refs.client_secret.value = data.client_secret;
                this.$refs.scope.value = data.scope;
            }
        };
    }
</script>



@endsection
