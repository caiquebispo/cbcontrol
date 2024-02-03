<div>
    <div>
        <section class="cart-item-model relative mt-3 mx-3 shadow my-3 sm:mr-3 sm:ml-3 p-2 min-h-[300px] cursor-pointer rounded-xl" value="{{$product->id}}">
            <div class="content-info-product grid sm:grid-cols-1 col-span-2 min-h-[200px]">
                <section class="bg-cover bg-no-repeat bg-center" @if(count($product->image) > 0)
                    style="background-image:url({{url(Storage::url($product->image->first()->path))}})"
                    @else
                    style="background-image:url('/img/product_photo/default/default.jpg')"
                    @endif
                </section>

            </div>
            <div class="footer-content-product mt-3 flex  justify-bettwee">
                <section>
                    <section>
                        <div class="title-product text-black font-bold text-sm mb-2">{{$product->name}}</div>
                    </section>
                    <x-button class="w-full bg-green-600 text-white" wire:click.prevent="addToCart({{ $product->id }})">ADD</x-button>
                </section>
            </div>
        </section>
    </div>
</div>