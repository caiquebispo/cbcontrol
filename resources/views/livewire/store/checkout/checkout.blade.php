<div>
    @if(!Auth::check() && $step > 1);
        <x-company-image :path="$company->image()->value('path')" />
    @endif
        <div>
            @if ($step === 1)
               <x-resume-cart :value="\Cart::subtotal()" :items="\Cart::content()" :delivery_price="$product->company->settings->delivery_price" />
            @elseif ($step === 2)
                @if(Auth::check())
                    <section class="banner-company w-full h-60 bg-gray-100 relative flex justify-center items-center shadow-lg by-10  bg-cover bg-no-repeat bg-center" @if($company->image()->value('path') != null) style="background-image: url('{{url(Storage::url($company->image()->value('path')))}}')" @else style="background-image: url('/img/logo/wallpaper-cb.png')" @endif>
                        <section class="content-path-user w-40 h-40 rounded-full bg-red-300 absolute bottom-[-50px] shadow-md bg-cover bg-no-repeat bg-center" @if(Auth::user()->image()->value('path') != null) style="background-image: url('{{url(Storage::url($company->image()->value('path')))}}')" @else style="background-image: url('/img/logo/default-user-logo.png')" @endif></section>
                    </section>
                    <section class="description w-full text-center text-gray-600 text-lg sm:text-3xl mt-24 my-10">
                        <h3>Ola, Bem-vindo de volta! {{Auth::user()->name}}</h3>
                    </section>
                @else
                    <x-store.checkout.form-create-acount />
                @endif
            @elseif ($step === 3)
                    <x-store.checkout.payment-method :paymentMethod="$paymentMethod" :delivery_method="$delivery_method" :delivery_price="$product->company->settings->delivery_price"/>
            @elseif ($step === 4)
                @if(Auth::check())
                    <x-address :address="Auth::user()->address" />
                @else
                    <x-store.checkout.register-address />
                @endif
            @endif
            @if ($step === 5)
                <x-store.checkout.thaks-for-buy-with-we />
            @endif
        </div>
    <x-store.checkout.next-steps-buttons :step="$step" />

</div>
