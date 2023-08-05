@props(['paymentMethod' ,'delivery_method'])
<x-card title="Informações de Pagamento">
    <x-errors />
    <form wire:submit.prevent="create" class="my-2">
        @csrf
        <div class="grid md:grid-cols-3 md:gap-6 my-3">
            <x-native-select
                label="Forma de Pagamento"
                placeholder="Forma de Pagamento"
                :options="[
                    ['paymentMethod' => 'Cartão de Crédito/Débito',  'value' => 'credit_card'],
                    ['paymentMethod' => 'À vista', 'value' => 'cash'],
                ]"
                option-label="paymentMethod"
                option-value="value"
                wire:model="paymentMethod"
            />
            @if ($paymentMethod === 'cash')
                <div>
                    <x-input type="number"  id="amount" label="Valor do Pagamento à Vista" placeholder="Site"  wire:model.defer="amount" />
                </div>
                <div class="mb-4 flex items-center">
                    <x-checkbox wire:model="hasExchange" id="right-label" label="Receber Troco?"/>
                </div>
            @endif
        </div>
        <div class="grid md:grid-cols-1 md:gap-6 my-3">
            <x-native-select
                label="Forma de Retirada"
                placeholder="Forma de Retirada"
                :options="[
                    ['delivery_method' => 'Entrega',  'value' => 'delivery'],
                    ['delivery_method' => 'Retirar no Local', 'value' => 'local_pickup'],
                ]"
                option-label="delivery_method"
                option-value="value"
                wire:model="delivery_method"
            />
        </div>
    </form>

</x-card>
