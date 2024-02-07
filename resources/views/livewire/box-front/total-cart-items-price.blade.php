<div>
    <div class="bg-slate-50 p-4 rounded-lg flex flex-col items-start">
        <div class="mb-3">
            <p class="text-lg">Preço Total: <span class="text-xl font-semibold">R$
                    {{number_format($total,2,',','.')}}</span></p>
            <p class="text-sm text-gray-600">Desconto: <span class="text-green-500">- R$ 0,00</span></p>
        </div>
        <button class="hidden bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded" @if(\Cart::content()->first()?->id) onclick="Livewire.emit('openModal', 'store.checkout.checkout',{{json_encode(['product' => \Cart::content()->first()?->id])}})" @endif>
            Finalizar Compra
        </button>
    </div>
</div>