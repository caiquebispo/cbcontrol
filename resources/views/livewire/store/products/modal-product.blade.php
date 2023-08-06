<div >
    <div class="content-product-item bg-white w-full sm:max-w-[750px] rounded-lg mx-auto pb-4 sm:mt-[75px]">
        @if($product->image->count() > 1)
            <livewire:store.products.slide-show-modal-product :images="$product->image" :wire:key="'images-product-'.$product->id"/>
        @else
            <div class="relative" style="padding: 0 10px">
             @php
            $path = $product->image->first()?->path  ? url(Storage::url($product->image->first()?->path)) :'/img/product_photo/default/default.jpg';
            @endphp
                <div class="img-product w-full min-h-[300px] mb-4 bg-cover bg-no-repeat bg-center flex items-center rounded-t-lg"
                    style="background-image:url('{{ $path }}')">
                </div>
            </div>
        @endif

        <div class="content-product-name mr-3 ml-3 my-3">
            <h1 class="text-xl sm:text-4xl font-bold text-black-600 product-name">{{ $product->name }}</h1>
            <div class="content-produc-category flex mt-3">
                <p class="text-sm text-black-600 font-bold">Categoria:</p>
                <p class="text-sm font-bold bg-orange-300 text-orange-600 ml-2 rounded-lg px-1">
                    {{ $product->categories->name ?? 'Não definida' }}
                </p>
            </div>
        </div>

        <div class="content-product-descritpion mr-3 ml-3">
            <h1 class="text-xl sm:text-2xl font-bold text-black-600">Sobre o Produto</h1>
            <article>
                @if($product->description)
                    <p class="text-gray-300 font-bold">{{ $product->description }}</p>
                @else
                    <p class="text-gray-300 font-bold">Esse Produto não possui descrição.</p>
                @endif
            </article>
        </div>

        <div class="ml-3 mb-3 flex flex-col justify-start text-xl sm:text-1xl mr-3 mt-3">
            <h1 class="text-xl sm:text-2xl font-bold text-black-600 my-3">Valor/Quantidade</h1>
            <div class="price-product flex items-center">
                <p class="font-bold mr-2">R$</p>
                <input type="number" @if($product->price) disabled @endif name="priceCliente"
                    class="outline-none w-[120px] bg-gray-50 border-none rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Ex: 30.00" value="{{ $product->price }}">

                <div class="flex items-center h-[30px] rounded-[10px] px-[10px]">
                    <button
                        class="px-[10px] text-lg {{ $quantity == 1 ? 'bg-gray-300 text-gray-600 cursor-not-allowed' : 'bg-orange-300 text-orange-600' }} font-bold rounded-lg"
                        wire:click.defer="{{ $quantity == 1 ? '' : '$emit(\'decrementQuantity\')' }}">-</button>
                    <div class="mx-3 font-bold">{{ $quantity }}</div>
                    <button
                        class="px-[10px] text-lg bg-orange-300 text-orange-600 font-bold rounded-lg"
                        wire:click.defer="$emit('incrementQuantity')">+</button>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <div class="w-full mr-3 ml-3 font-bold text-2xl">
                <h3>Observações</h3>
            </div>
            <div class="mx-3 grid md:grid-cols-1 md:gap-6">
                <textarea wire:model.defer="observation" id="message" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder=""></textarea>
            </div>
        </div>

        <div class="mr-3 ml-3 my-4 flex items-center">
            <div class="add-cart bg-green-300 text-green-600 font-bold p-2 rounded-xl mr-4 cursor-pointer"
                wire:click.prevent="addToCart({{ $product->id }}, {{ $quantity }})">
                Adicionar ao Carrinho
            </div>
            <div class="closed-modal bg-red-300 text-red-600 font-bold p-2 rounded-xl cursor-pointer"
                wire:click="$emit('closeModal')">Cancelar
            </div>
        </div>
    </div>
</div>
