<div>
    <x-native-select placeholder="Selecione um cliente" :options="$clients" option-label="full_name" option-value="id" wire:model="client_id" wire:change="change" />
</div>