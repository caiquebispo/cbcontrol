<div>
    <div class="container mx-auto sm:px-6 lg:px-8">
        <x-table.content-table>
            <x-table.actions  :showButtonExport="false">
                <x-slot name="buttonCreate">
                    <livewire:profiles.create />
                </x-slot>
            </x-table.actions>
            <x-table>
                <x-table.thead>
                    <x-table.th>NOME</x-table.th>
                    <x-table.th>STATUS</x-table.th>
                    <x-table.th class="text-right">ACTIONS</x-table.th>
                </x-table.thead>
                <x-table.tbody></x-table.tbody>
            </x-table>
            <div class="p-4"></div>
        </x-table.content-table>
    </div>
</div>
