<div class="container mx-auto px-4">
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold my-4">Carrinho de Compras</h2>
        <button @if(sizeof(\Cart::content()) > 0) wire:click.prevent="clearCart" @endif
            class="w-10 h-10 mt-3 flex items-center justify-center rounded-full mx-3 mb-4 bg-red-400 text-red-600
            dark:text-red-200">
            <x-button-trash />
        </button>
    </div>
    @if(sizeof(\Cart::content()) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach(\Cart::content() as $key => $item)
        <!-- Item do Carrinho -->

        <div class="bg-white rounded shadow p-4">
            @php
            $path = $item->options['path_img'] != null || ''? url(Storage::url($item->options['path_img']))
            :'/img/product_photo/default/default.jpg';
            @endphp
            <img src="{{$path}}" alt="{{$item->options['description'] ?? 'Imagem do Produto' }}"
                class="w-full h-36 mb-4 rounded">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">{{$item->name}}</h3>
            <p class="font-bold text-sm text-gray-400 mb-4">{{$item->options['description'] ?? 'Não temos mais
                informações disponível sobre esse produto' }}</p>
            <span class="mb-4 text-gray-800">R$ {{number_format($item->price,2,',','.')}}</span>
            <div class="flex items-center mt-4">
                <div class="flex w-48">
                    <button class="bg-orange-300 hover:bg-orange-400 text-orange-700 px-3 py-2 rounded-l"
                        wire:click.prevent="decrement('{{ $item->rowId }}')">-</button>
                    <div class="w-full px-3 py-2  bg-slate-50 text-center font-bold">{{$item->qty}}</div>
                    <button class="bg-orange-300 hover:bg-orange-400 text-orange-700 px-3 py-2 rounded-r"
                        wire:click.prevent="increment('{{ $item->rowId }}')">+</button>
                </div>
                <button wire:click.prevent="remove('{{ $item->rowId }}')"
                    class="w-10 h-10 mt-3 flex items-center justify-center rounded-full mx-3 mb-4 bg-red-400 text-red-600 dark:text-red-200">
                    <x-button-trash />
                </button>
            </div>

        </div>

        @endforeach
        <!-- Outros Itens do Carrinho -->
    </div>
    @else
    <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
        role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Aviso</span>
        <div>
            <span class="font-medium">Aviso!</span> Seu Carrinho está vazio.
        </div>
    </div>
    @endif

    <div class="my-8 bg-slate-50 p-4 rounded-lg flex justify-between items-center">
        <div>
            <p class="text-lg">Preço Total: <span class="text-xl font-semibold">R$
                    {{number_format(\Cart::subtotal(),2,',','.')}}</span></p>
            <p class="text-sm text-gray-600">Desconto: <span class="text-green-500">- R$ 0,00</span></p>
        </div>
        <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded"
               @if(\Cart::content()->first()?->id) onclick="Livewire.emit('openModal', 'store.checkout.checkout',{{json_encode(['product' => \Cart::content()->first()?->id])}})" @endif>
            Finalizar Compra
        </button>
    </div>
</div>
