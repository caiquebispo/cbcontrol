@props(['items','value','delivery_price'])
<div class="container mx-auto p-4">
    <h1 class="text-lg sm:text-2xl font-bold mb-8 text-left text-gray-700">Resumo do Carrinho de Compras</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 ">
        <div class="bg-white rounded-lg shadow-lg p-4 max-h-52 overflow-y-auto">
            <h2 class="text-2xl font-bold mb-4">Produtos</h2>

            <div class="space-y-4">
                @foreach($items as $item)
                    <div>
                        <div class="font-semibold">{{$item->name}}</div>
                        <div class="text-gray-600 text-sm">{{$item->options['description'] ?? 'SEM DESCRIAÇÃO'}}</div>
                        <div class="flex items-center justify-between">
                            <div class="text-gray-600">{{$item->qty}} x R$ {{number_format($item->price,2,',','.')}}</div>
                            <div class="text-gray-600">R$ {{number_format(($item->qty*$item->price),2,',','.')}}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Total do carrinho com sombra -->
        <div class="bg-white rounded-lg shadow-md p-4 mt-4 md:mt-0 max-h-52">
            <h2 class="text-2xl font-bold mb-4">Total do Carrinho</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-gray-600">Subtotal:</div>
                <div class="text-right">R$ {{number_format($value, 2,',','.')}}</div>
                <div class="text-gray-600 hidden">Frete:</div>
                <div class="text-right hidden">R$ {{number_format($delivery_price,2,',','.')}}</div>
            </div>
            <div class="flex justify-between border-t-2 pt-4 mt-4">
                <span class="text-xl font-bold">Total:</span>
                <span class="text-xl font-bold">R$ {{number_format(($value+$delivery_price), 2,',','.')}}</span>
            </div>
        </div>
    </div>
</div>
