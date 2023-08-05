<div>
    <x-company-image :path="$company->image()->value('path')" />
    @if(Auth::check())
        <div class="mx-3">
            <h4 class="mb-3 font-bold text-gray-900 text-lg my-5">Olá {{Auth::user()->name}}, Bem-vindo de volta.</h4>
            <hr class="mb-4">
        </div>
    @endif

    <div>
        @if ($step === 1)
           <x-resume-cart :value="\Cart::subtotal()" :items="\Cart::content()" :delivery_price="$product->company->settings->delivery_price" />
        @elseif ($step === 2)
            <x-store.checkout.form-create-acount />
        @elseif ($step === 3)
            <x-store.checkout.payment-method :paymentMethod="$paymentMethod" :delivery_method="$delivery_method" />
        @elseif ($step === 4)
           <x-store.checkout.register-address />
        @endif
        @if ($step === 5)
            <x-store.checkout.thaks-for-buy-with-we />
        @endif
       <x-store.checkout.next-steps-buttons :step="$step" />
    </div>

</div>
