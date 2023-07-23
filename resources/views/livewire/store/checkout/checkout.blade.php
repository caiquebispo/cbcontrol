<div>
    <x-company-image :path="$company->image()->value('path')" />
    @if(Auth::check())
        <div class="mx-3">
            <h4 class="mb-3 font-bold text-gray-900 text-lg my-5">Olá {{Auth::user()->name}}, Bem-vindo de volta.</h4>
            <hr class="mb-4">
        </div>
        <x-resume-cart :items="\Cart::content()" :value="\Cart::subtotal()" :delivery_price="$company->settings->delivery_price"/>
        <x-form-of-payment :has_delivery="$company->settings->has_delivery" :has_limit_price_delivery="$company->settings->has_limit_price_delivery" :value="\Cart::subtotal()" />
    @else
        <h3>Não está logado</h3>
        <x-resume-cart :items="\Cart::content()" :value="\Cart::subtotal()" :delivery_price="$company->settings->delivery_price" />
    @endif
</div>
