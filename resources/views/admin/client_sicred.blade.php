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
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col" x-data="{ 'showModal': false }" @keydown.escape="showModal = false" x-cloak>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <button type="button" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full btn_edit_client_sicred my-2" @click="showModal = true" value="" onclick="createClientSicred()">Cadastrar</button>
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
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?= '<script>const clients = ' . json_encode($clients) . '</script>' ?>
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
                                <button type="button" class="bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full btn_edit_client_sicred" @click="showModal = true" onclick="editClientSicred(this.value)" value="{{$key}}">Editar</button>
                            </td>
                        </tr>
                        @endforeach

                        <!-- More items... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.modal_client_sicred_edit')

</div>


@endsection