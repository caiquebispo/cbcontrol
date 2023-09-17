<div>
    <div class="container mx-auto sm:px-6 lg:px-8">
        <x-table.content-table>
            <x-table.actions  :showButtonExport="false">
                <x-slot name="buttonCreate">
                <livewire:users.create />
                </x-slot>
            </x-table.actions>
            <x-table>
                <x-table.thead>
                    <x-table.th wire:click.prevent="sortBy('name')" :sortable="true" :direction="$sortDirection">NOME</x-table.th>
                    <x-table.th wire:click.prevent="sortBy('email')" :sortable="true" :direction="$sortDirection">E-MAIL</x-table.th>
                    <x-table.th wire:click.prevent="sortBy('company_id')" :sortable="true" :direction="$sortDirection">EMPRESA</x-table.th>
                    <x-table.th wire:click.prevent="sortBy('status')" :sortable="true" :direction="$sortDirection">STATUS</x-table.th>
                    <x-table.th class="text-center">ACTIONS</x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    @foreach($users as $user)
                        <x-table.tr>
                            <x-table.th>{{$user->name ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th>{{$user->email ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th>{{$user->company->corporate_reason ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th>{{$user->status }}</x-table.th>
                            <x-table.th class="flex  justify-evenly">
                                <livewire:users.update :user="$user" :wire:key="'user-update-'.$user->id"/>
                                <livewire:users.update-password :user="$user" :wire:key="'user-update-password-'.$user->id"/>
{{--                                <livewire:users.delete :user="$user" :wire:key="'user-delete-'.$user->id"/>--}}
                            </x-table.th>
                        </x-table.tr>
                    @endforeach
                </x-table.tbody>
            </x-table>
            <div class="p-4">
                {{ $users->links() }}
            </div>
        </x-table.content-table>
    </div>
</div>
