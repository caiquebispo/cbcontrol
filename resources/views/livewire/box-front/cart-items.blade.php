<div class="p-4">
    <article class="my-2 text-2xl font-bold text-gray-700">
        <p>Operador(a): {{ auth()->user()->name }}</p>
    </article>
    <div class="my-6">
        <div class="flex justify-between space-x-2 mb-4">
            <livewire:box-front.register-client />
            <livewire:box-front.receveid />
            <livewire:expenses.create />
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
    <div class="flex items-center mb-4">
        <input id="default-checkbox" type="checkbox" wire:model="is_retroactive"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
        <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">É
            retroativo?</label>
    </div>
    <livewire:box-front.total-cart-items-price />
    <x-box-front.actions-buttons />
    <x-box-front.table-items :items="$items" />

</div>
