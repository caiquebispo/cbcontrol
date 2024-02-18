<div class="p-4">
    <article class="my-2 text-2xl font-bold text-gray-700">
        <p>Operador(a): {{ auth()->user()->name }}</p>
    </article>
    <div class="my-6">
        <div class="grid grid-cols-3 gap-2 mb-4">
            <livewire:box-front.register-client />
            <livewire:box-front.receveid />
        </div>
        <div class="grid grid-cols-2 gap-4 items-center">
            <x-box-front.select-client />
            <x-box-front.select-delivery-man />
        </div>
        <div class="grid md:grid-cols-2 md:gap-6 my-2">
            <x-box-front.select-payment-method />
            <x-box-front.select-type-delivery />
        </div>
    </div>
    <div class="grid md:grid-cols-2 md:gap-2 my-3">
        <x-box-front.select-increase-or-decrease />
        <x-input label="Valor" placeholder="Valor" class="my-2" wire:model.defer="value_increase_or_decrease" />
    </div>
    <livewire:box-front.total-cart-items-price />
    <x-box-front.actions-buttons />
    <x-box-front.table-items :items="$items" />

</div>
