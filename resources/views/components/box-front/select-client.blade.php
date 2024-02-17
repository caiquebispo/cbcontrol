<x-select wire:model.defer="client_id" placeholder="Selecione um cliente" :async-data="route('client.getAll')" option-label="full_name"
    option-value="id" />
