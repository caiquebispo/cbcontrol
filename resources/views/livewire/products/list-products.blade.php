<div>
    <div class="container mx-auto sm:px-6 lg:px-8">
        <x-table.content-table>
            <x-table.actions :modelExport="'products'" :showButtonExport="true">
                <x-slot name="buttonCreate">
                    <livewire:products.create />
                </x-slot>
            </x-table.actions>
            <x-table>
                <x-table.thead>
                    <x-table.th wire:click.prevent="sortBy('name')" :sortable="true" :direction="$sortDirection">NOME</x-table.th>
                    <x-table.th class="text-center" >CATEGORIA</x-table.th>
                    <x-table.th class="text-center" wire:click.prevent="sortBy('price')" :sortable="true" :direction="$sortDirection">VALOR</x-table.th>
                    <x-table.th class="text-center" wire:click.prevent="sortBy('quantity')" :sortable="true" :direction="$sortDirection">Qt Estoque</x-table.th>
                    <x-table.th class="text-right">ACTIONS</x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    @foreach($products as $product)
                        <x-table.tr>
                            <x-table.th>{{$product->name ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th class="text-center">{{$product->categories->name ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th class="text-center">R$ {{ number_format($product->price, 2, ',','.')}}</x-table.th>
                            <x-table.th class="text-center">{{$product->quantity ?? 'NÃO DEFINIDO'}}</x-table.th>
                            <x-table.th class="flex  justify-end">
{{--                                <livewire:products.update :product="$product" :wire:key="'product-update-'.$product->id"/>--}}
{{--                                <livewire:products.delete :product="$product" :wire:key="'product-delete-'.$product->id"/>--}}
                            </x-table.th>
                        </x-table.tr>
                    @endforeach
                </x-table.tbody>
            </x-table>
            <div class="p-4">
                {{ $products->links() }}
            </div>
        </x-table.content-table>
    </div>
</div>
