<div>
@if(count($row->address) > 0)
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                   ESTADO
                </th>
                <th scope="col" class="px-6 py-3">
                    CEP
                </th>
                <th scope="col" class="px-6 py-3">
                    CIDADE
                </th>
                <th scope="col" class="px-6 py-3">
                    BAIRRO
                </th>
                <th scope="col" class="px-6 py-3">
                    RUA
                </th>
                <th scope="col" class="px-6 py-3">
                    Nª DA CASA
                </th>
                <th scope="col" class="px-6 py-3">
                    COMPLEMENTO
                </th>
                <th scope="col" class="px-6 py-3">
                    AÇÕES
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{$row->address[0]->states}}
                </th>
                <td class="px-6 py-4">
                     {{$row->address[0]->zipe_code}}
                </td>
                <td class="px-6 py-4">
                    {{$row->address[0]->city}}
                </td>
                <td class="px-6 py-4">
                     {{$row->address[0]->neighborhood}}
                </td>
                <td class="px-6 py-4">
                     {{$row->address[0]->road}}
                </td>
                <td class="px-6 py-4">
                     {{$row->address[0]->number}}
                </td>
                <td class="px-6 py-4">
                     {{$row->address[0]->complement}}
                </td>
                <td class="px-6 py-4 flex">
                    <x-button-update onclick="Livewire.emit('openModal', 'utils.address.update', {{json_encode(['address' => $row->address[0]])}})"/>
                    <livewire:utils.address.delete :address="$row->address[0]"/>
                </td>
            </tr>
        </tbody>
    </table>
</div>   
@else
    <div class="w-full flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
    role="alert">
    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
            clip-rule="evenodd"></path>
    </svg>
    <span class="sr-only">Aviso</span>
    <div>
        <span class="font-medium">Aviso!</span> ENDEREÇO NÃO CADASTRADO !
    </div>
</div>
@endif
</div>
