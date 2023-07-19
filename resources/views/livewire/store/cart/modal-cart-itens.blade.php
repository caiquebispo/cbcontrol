<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold my-4">Carrinho de Compras</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach(Cart::content() as $product) 
        <!-- Item do Carrinho -->
        <div class="bg-white rounded shadow p-4">
            @php
                $path = $product->options['path_img'] != null || ''? url(Storage::url($product->options['path_img'])) : '/img/product_photo/default/default.jpg';
            @endphp
            <img src="{{$path}}" alt="{{$product->options['description'] ?? 'Imagem do Produto' }}" class="w-full h-36 mb-4 rounded">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">{{$product->name}}</h3>
            <p class="font-bold text-sm text-gray-400 mb-4">{{$product->options['description'] ?? 'Não temos mais informações disponível sobre esse produto' }}</p>
            <span class="mb-4 text-gray-800">R$ {{number_format($product->price,2,',','.')}}</span>
            <div class="flex items-center mt-4">
                <div class="flex w-48">
                    <button class="bg-orange-300 hover:bg-orange-400 text-orange-700 px-3 py-2 rounded-l">-</button>
                    <div class="w-full px-3 py-2  bg-slate-50 text-center font-bold">{{$product->qty}}</div>
                    <button class="bg-orange-300 hover:bg-orange-400 text-orange-700 px-3 py-2 rounded-r">+</button>
                </div>
                <button class="w-10 h-10 mt-3 flex items-center justify-center rounded-full mx-3 mb-4 bg-red-400 text-red-600 dark:text-red-200">
                    <x-button-trash />
                </button>
            </div>
            
        </div>
        @endforeach
        <!-- Outros Itens do Carrinho -->
    </div>

    <div class="my-8 bg-slate-50 p-4 rounded-lg flex justify-between items-center">
        <div>
            <p class="text-lg">Preço Total: <span class="text-xl font-semibold">R$ {{number_format(\Cart::subtotal(),2,',','.')}}</span></p>
            <p class="text-sm text-gray-600">Desconto: <span class="text-green-500">- R$ 0,00</span></p>
        </div>
        <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded animate-bounce">Finalizar Compra</button>
    </div>
</div>
