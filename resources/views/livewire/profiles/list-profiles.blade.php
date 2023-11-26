<div>
    <div class="container mx-auto sm:px-6 lg:px-8">
        <x-table.content-table>
            <x-table.actions  :showButtonExport="false">
                
                <x-slot name="buttonCreate">
                    @can('create-permission')
                        <livewire:profiles.create />
                    @endcan
                </x-slot>
            </x-table.actions>
            <x-table>
                <x-table.thead>
                    <x-table.th>NOME</x-table.th>
                    <x-table.th>STATUS</x-table.th>
                    <x-table.th class="text-right">ACTIONS</x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    @foreach($profiles as $profile)
                        <x-table.tr>
                            <x-table.th>{{$profile->name ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th>{{$profile->status ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th class="flex  justify-end">
                                <livewire:profiles.update :profile="$profile" wire:key="{{now()}}"/>
                                <livewire:profiles.users  :profile="$profile" wire:key="{{now()}}"/>
                                <livewire:profiles.delete :profile="$profile" wire:key="{{now()}}"/>
                            </x-table.th>
                        </x-table.tr>
                    @endforeach
                </x-table.tbody>
            </x-table>
            <div class="p-4">
                {{ $profiles->links() }}
            </div>
        </x-table.content-table>
    </div>
</div>
