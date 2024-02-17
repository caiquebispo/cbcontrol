<x-native-select label="Forma de Retirada" placeholder="Forma de Retirada" :options="[
    ['delivery_method' => 'Entregar', 'value' => 'delivery'],
    ['delivery_method' => 'Retirar no Local', 'value' => 'local_pickup'],
]" option-label="delivery_method"
    option-value="value" wire:model.defer="delivery_method" />
