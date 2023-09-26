<div>
    <div class="container mx-auto sm:px-6 lg:px-8">
        <x-table.content-table>
            <x-table.actions  :showButtonExport="false">
                <x-slot name="buttonCreate">
                    <livewire:networks.create />
                </x-slot>
            </x-table.actions>
            <x-table>
                <x-table.thead>
                    <x-table.th wire:click.prevent="sortBy('name')" :sortable="true" :direction="$sortDirection">NOME</x-table.th>
                    <x-table.th class="text-right">ACTIONS</x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    @foreach($networks as $network)
                        <x-table.tr>
                            <x-table.th>{{$network->name ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th class="flex  justify-end">
                                <livewire:networks.show :group="$network" :wire:key="'network-show-'.$network->id"/>
                                <livewire:networks.update :group="$network" :wire:key="'network-update-'.$network->id"/>
                            </x-table.th>
                        </x-table.tr>
                    @endforeach
                </x-table.tbody>
            </x-table>
            <div class="p-4">
                {{ $networks->links() }}
            </div>
        </x-table.content-table>
    </div>
</div>
