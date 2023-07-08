<div>
    <div>
        @if(count($products) > 0)
            <div class="grid grid-cols-1 gap-1 sm:grid-cols-4  sm:gap-2 py-4">
                @foreach ($products as $product)
                <livewire:store.products.product :product="$product" />
                @endforeach
            </div>
        @else
            <div class=" mt-4 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                <p class="font-bold">Aviso</p>
                <p>Essa Emprea ainda não fez o cadastro dos seus produtos</p>
            </div>
        @endif
    </div>
</div>