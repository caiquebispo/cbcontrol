<div class="p-4">
    <article class="my-2 text-2xl font-bold text-gray-700">
        <p>Operador(a): {{auth()->user()->name}}</p>
    </article>
    <div class="my-6">
        <div class="grid grid-cols-3 gap-4 items-center">
            <div class="col-span-2 ">
                <x-select wire:model.defer="client_id" placeholder="Selecione um cliente" :async-data="route('client.getAll')" option-label="full_name" option-value="id" />
            </div>
            <div>
                <livewire:box-front.register-client />
            </div>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6 my-2">
            <x-native-select label="Forma de Pagamento" placeholder="Forma de Pagamento" :options="[
                    ['paymentMethod' => 'Cartão de Crédito/Débito',  'value' => 'credit_card'],
                    ['paymentMethod' => 'Pix/ Tranferência',  'value' => 'pix_or_transfer_bank'],
                    ['paymentMethod' => 'À vista', 'value' => 'cash'],
                    ['paymentMethod' => 'Na nota', 'value' => 'in_count'],
                ]" option-label="paymentMethod" option-value="value" wire:model.defer="paymentMethod" />
            <x-native-select label="Forma de Retirada" placeholder="Forma de Retirada" :options="[
                        ['delivery_method' => 'Entregar',  'value' => 'delivery'],
                        ['delivery_method' => 'Retirar no Local', 'value' => 'local_pickup'],
                ]" option-label="delivery_method" option-value="value" wire:model.defer="delivery_method" />
        </div>
    </div>
    <livewire:box-front.total-cart-items-price />
    <section class="footer bg-slate-150 mt-6 border border-gray-300 p-2 rounded-lg">
        <div class="grid md:grid-cols-3 md:gap-6 my-3">
            <button type="button" class="bg-green-300 text-green-600 text-lg p-2 rounded-md" wire:click="finish">Finalizar</button>
            <button type="button" class="bg-red-300 text-red-600 text-lg p-2 rounded-md" wire:click="clearCart">Cancelar</button>
            <button type="button" class="bg-blue-300 text-blue-600 text-lg p-2 rounded-md" wire:click="exportSummarySales">Baixar Relatório</button>
        </div>
    </section>
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
            @foreach($items as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">{{$item->name}}</td>
                <td class="px-6 py-4">{{number_format($item->price,2,',','.')}}</td>
                <td class="px-6 py-4">
                    <div class="flex w-48">
                        <button class="bg-orange-300 hover:bg-orange-400 text-orange-700 px-3 py-2 rounded-l" wire:click.prevent="decrement('{{ $item->rowId }}')">-</button>
                        <div class="w-full px-3 py-2  bg-slate-50 text-center font-bold">{{$item->qty}}</div>
                        <button class="bg-orange-300 hover:bg-orange-400 text-orange-700 px-3 py-2 rounded-r" wire:click.prevent="increment('{{ $item->rowId }}')">+</button>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <button wire:click.prevent="remove('{{ $item->rowId }}')" class="w-10 h-10 mt-3 flex items-center justify-center rounded-full mx-3 mb-4 bg-red-400 text-red-600 dark:text-red-200">
                        <x-button-trash />
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>