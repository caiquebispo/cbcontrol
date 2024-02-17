@props(['items' => []])
<table class="my-6 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">Produto</th>
            <th scope="col" class="px-6 py-3">Preço</th>
            <th scope="col" class="px-6 py-3 text-center">Qtd</th>
            <th scope="col" class="px-6 py-3">Remover</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">{{ $item->name }}</td>
                <td class="px-6 py-4">{{ number_format($item->price, 2, ',', '.') }}</td>
                <td class="px-6 py-4">
                    <div class="flex w-48">
                        <button class="bg-orange-300 hover:bg-orange-400 text-orange-700 px-3 py-2 rounded-l"
                            wire:click.prevent="decrement('{{ $item->rowId }}')">-</button>
                        <div class="w-full px-3 py-2  bg-slate-50 text-center font-bold">{{ $item->qty }}</div>
                        <button class="bg-orange-300 hover:bg-orange-400 text-orange-700 px-3 py-2 rounded-r"
                            wire:click.prevent="increment('{{ $item->rowId }}')">+</button>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <button wire:click.prevent="remove('{{ $item->rowId }}')"
                        class="w-10 h-10 mt-3 flex items-center justify-center rounded-full mx-3 mb-4 bg-red-400 text-red-600 dark:text-red-200">
                        <x-button-trash />
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
