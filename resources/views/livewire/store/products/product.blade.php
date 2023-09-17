<div>
    <div >
        <a href="#" style="text-decoration: none" class="hover:text-gray-600" onclick="event.preventDefault(); Livewire.emit('openModal', 'store.products.modal-product', {{ json_encode(['product' => $product->id]) }})">
            <section
                class="cart-item-model relative mt-3 mx-3 shadow my-3 sm:mr-3 sm:ml-3 p-2 min-h-[250px] cursor-pointer rounded-xl"
                value="{{$product->id}}">
                <div class="content-info-product grid sm:grid-cols-2 col-span-2 min-h-[200px]">
                    <section>
                        <div class="title-product text-black font-bold text-sm mb-2">{{$product->name}}</div>
                        <div class="title-product  font-bold text-sm text-gray-400">
                        {{$product->description ?? 'Não temos mais informações disponível sobre esse produto' }}

                        </div>
                    </section>
                    <section class="bg-cover bg-no-repeat bg-center"
                        @if(count($product->image) > 0)
                            style="background-image:url({{url(Storage::url($product->image->first()->path))}})"
                        @else
                            style="background-image:url('/img/product_photo/default/default.jpg')"
                        @endif
                    </section>
                </div>
                <div class="footer-content-product mt-3 flex  justify-bettwee">
                    <section>
                        <section class="font-bold text-green-600">
                            @if($product->price != null)
                                R$ {{number_format($product->price,2,",",".")}}
                            @else
                                Valor a combinar.
                            @endif
                        </section>
                    </section>
                </div>
            </section>
        </a>
    </div>
</div>
