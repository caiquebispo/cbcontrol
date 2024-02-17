<x-native-select label="Acréscimo / Decréscimo" placeholder="Adicionar acréscimo / decréscimo" :options="[['name' => 'Acréscimo', 'value' => 1], ['name' => 'Decréscimo', 'value' => 0]]"
    option-label="name" option-value="value" wire:model.defer="type_increase_or_decrease" />
