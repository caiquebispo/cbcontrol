<div class="max-w-7xl mx-auto">
    <x-card title="Update Client">
        <x-errors />
        <form wire:submit.prevent="update" class="my-2">
            @csrf
            <x-native-select class="my-2"
                label="Selecione um grupo par ao cliente"
                placeholder="Selecionar grupo"
                :options="$groups"
                option-label="name"
                option-value="id"
                wire:model="group_id"
            />
            <x-input label="Nome Completo" placeholder="Nome completo" wire:model.defer="client.full_name" class="my-2"/>
            <x-input label="Nª Telefone" placeholder="Nª Telefone" wire:model.defer="client.number_phone" class="my-2"/>
            <x-input label="Valor" placeholder="Valor" wire:model.defer="client.value" class="my-2"/>
            <x-input label="Forma de Pagamento" placeholder="Forma de Pagamento" wire:model.defer="client.payment_method" class="my-2"/>
            <x-input label="Local" placeholder="Local" wire:model.defer="client.local" class="my-2"/>
            <x-input label="Entrega" placeholder="Entrega" wire:model.defer="client.delivery" class="my-2"/>
            <x-button type="submit" icon="pencil" primary label="ATUALIZAR" class="my-2"/>
        </form>
    </x-card>
</div>
