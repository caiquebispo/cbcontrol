<div>
    <div class="container mx-auto sm:px-6 lg:px-8">
        <x-table.content-table>
            <x-table.actions :modelExport="'clients'" :showButtonExport="true">
                <x-slot name="buttonCreate">
                    <livewire:clients.increase-or-decrease />
                    <livewire:clients.create />
                </x-slot>
            </x-table.actions>
            <x-table>
                <x-table.thead>
                    <x-table.th wire:click.prevent="sortBy('full_name')" :sortable="true" :direction="$sortDirection">NOME</x-table.th>
                    <x-table.th class="text-center" >GRUPO</x-table.th>
                    <x-table.th class="text-center" wire:click.prevent="sortBy('number_phone')" :sortable="true" :direction="$sortDirection">TELEFONE</x-table.th>
                    <x-table.th class="text-center" wire:click.prevent="sortBy('value')" :sortable="true" :direction="$sortDirection">VALOR</x-table.th>
                    <x-table.th class="text-center" wire:click.prevent="sortBy('local')" :sortable="true" :direction="$sortDirection">LOCAL</x-table.th>
                    <x-table.th class="text-center" wire:click.prevent="sortBy('payment_method')" :sortable="true" :direction="$sortDirection">PAGAMENTO</x-table.th>
                    <x-table.th class="text-center" wire:click.prevent="sortBy('delivery')" :sortable="true" :direction="$sortDirection">ENTREGA</x-table.th>
                    <x-table.th class="text-right">ACTIONS</x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    @foreach($clients as $client)
                        <x-table.tr>
                            <x-table.th>{{$client->full_name ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th class="text-center">{{$client->groups->value('name') ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th class="text-center">{{$client->number_phone ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th class="text-center">R$ {{ number_format($client->value, 2, ',','.')}}</x-table.th>
                            <x-table.th class="text-center">{{$client->local ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th class="text-center">{{$client->payment_method ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th class="text-center">{{$client->delivery ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th class="flex  justify-end">
                                <livewire:clients.update :client="$client" :wire:key="'client-update-'.$client->id"/>
                                <livewire:clients.delete :client="$client" :wire:key="'client-delete-'.$client->id"/>
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
