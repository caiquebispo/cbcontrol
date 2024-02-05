<div>
    <div class="container mx-auto sm:px-6 lg:px-8">
        <x-table.content-table>
            <x-table.actions :modelExport="'clients'" :showButtonExport="false">
                <x-slot name="buttonCreate">
                    <livewire:box-front.register-client />
                </x-slot>
            </x-table.actions>
            <x-table>
                <x-table.thead>
                    <x-table.th wire:click.prevent="sortBy('full_name')" :sortable="true" :direction="$sortDirection">NOME</x-table.th>
                    <x-table.th class="text-center">TELEFONE</x-table.th>
                    <x-table.th class="text-center">ANIVERARIO</x-table.th>
                    <x-table.th class="text-center">RUA</x-table.th>
                    <x-table.th class="text-center">BAIRRO</x-table.th>
                    <x-table.th class="text-center">Nª</x-table.th>
                    <x-table.th class="text-right">ACTIONS</x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    @foreach($clients as $client)
                    <x-table.tr>
                        <x-table.th>{{$client->full_name ?? 'NÃO DEFINIDO'}}</x-table.th>
                        <x-table.th class="text-center">{{$client->number_phone ?? 'NÃO DEFINIDO'}}</x-table.th>
                        <x-table.th class="text-center">{{$client->birthday ?? 'NÃO DEFINIDO'}}</x-table.th>
                        <x-table.th class="text-center">{{$client->address()->first()->road ?? 'NÃO DEFINIDO'}}</x-table.th>
                        <x-table.th class="text-center">{{$client->address()->first()->neighborhood ?? 'NÃO DEFINIDO'}}</x-table.th>
                        <x-table.th class="text-center">{{$client->address()->first()->number ?? 'NÃO DEFINIDO'}}</x-table.th>
                        <x-table.th class="flex  justify-end">
                            <livewire:clients.shopping-list :client="$client" :wire:key="'client-shopping-'.$client->id" />
                            <div class="mx-3">
                                <livewire:clients.update :client="$client" :wire:key="'client-update-'.$client->id" />
                            </div>
                            <livewire:clients.delete :client="$client" :wire:key="'client-delete-'.$client->id" />
                        </x-table.th>
                    </x-table.tr>
                    @endforeach
                </x-table.tbody>
            </x-table>
            <div class="p-4">
                {{ $clients->links() }}
            </div>
        </x-table.content-table>
    </div>
</div>