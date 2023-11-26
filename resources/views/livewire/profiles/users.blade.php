<div>
    <x-bi-person-fill-add class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer w-6 h-6" wire:click="$toggle('showModal','true')"/>
    <x-modal.main title="Adicionar perfil: ({{$profile->name}})" :show="$showModal">
        <x-slot:body>
            <x-table.content-table>
                <x-table.actions  :showButtonExport="false">
                    <x-slot name="buttonCreate"></x-slot>
                </x-table.actions>
                <x-table>
                    <x-table.thead>
                        <x-table.th wire:click.prevent="sortBy('name')" :sortable="true" :direction="$sortDirection">MENU</x-table.th>
                        <x-table.th>Status</x-table.th>
                        <x-table.th class="text-right">ACTIONS</x-table.th>
                    </x-table.thead>
                    <x-table.tbody>
                        @foreach($users as $user)
                            <x-table.tr>
                                <x-table.th>{{$user->name ?? 'NÃO DEFINIDO'}}</x-table.th>
                                <x-table.th>{{$user->status ?? 'NÃO DEFINIDO'}}</x-table.th>
                                <x-table.th class="flex  justify-end">
                                    <livewire:profiles.toggle :user="$user" :profile="$profile"  wire:key="{{now()}}"/>
                                </x-table.th>
                            </x-table.tr>
                        @endforeach
                    </x-table.tbody>
                </x-table>
                <div class="p-4">
                    {{ $users->links() }}
                </div>
            </x-table.content-table> 
        </x-slot:body>
    </x-modal.main>
</div>
