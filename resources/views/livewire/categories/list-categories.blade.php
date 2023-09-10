<div>
    <div class="container mx-auto sm:px-6 lg:px-8">
        <x-table.content-table>
            <x-table.actions  :showButtonExport="false">
                <x-slot name="buttonCreate">
                    <livewire:categories.create />
                </x-slot>
            </x-table.actions>
            <x-table>
                <x-table.thead>
                    <x-table.th wire:click.prevent="sortBy('name')" :sortable="true" :direction="$sortDirection">NOME</x-table.th>
                    <x-table.th class="text-right">ACTIONS</x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    @foreach($categories as $category)
                        <x-table.tr>
                            <x-table.th>{{$category->name ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th class="flex  justify-end">
{{--                                <livewire:groups.update :group="$category" :wire:key="'category-update-'.$category->id"/>--}}
                                <livewire:categories.delete :category="$category" :wire:key="'category-delete-'.$category->id"/>
                            </x-table.th>
                        </x-table.tr>
                    @endforeach
                </x-table.tbody>
            </x-table>
            <div class="p-4">
                {{ $categories->links() }}
            </div>
        </x-table.content-table>
    </div>
</div>
