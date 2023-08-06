@props(['paymentMethod' ,'delivery_method', 'delivery_price'])
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
            @if ($delivery_method === 'delivery')
                <div class="w-full flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                     role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">@if(!$delivery_price) Parrabéns @else Aviso @endif </span>
                    <div>
                        <span class="font-medium">@if(!$delivery_price) Parrabéns @else Aviso @endif</span>
                        @if(!$delivery_price)  Você ganhou uma delivery gratis!  @else Você terá um custo adicional de R$ {{number_format($delivery_price, 2,'.',',')}}@endif
                    </div>
                </div>
            @endif
        </div>
    </form>

</x-card>
