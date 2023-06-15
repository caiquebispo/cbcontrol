<div class="max-w-7xl mx-auto">
    <x-card title="Create new Client">
        <x-errors />
        <form wire:submit.prevent="create" class="my-2">
            @csrf
            <x-native-select class="my-2"
                label="Selecione um grupo par ao cliente"
                placeholder="Selecionar grupo"
                :options="$groups"
                option-label="name"
                option-value="id"
                wire:model="group_id"
            />
            <x-input label="Nome Completo" placeholder="Nome Completo" wire:model.defer="full_name" class="my-2"/>
            <x-input label="Nª Telefone" placeholder="Nª Telefone" wire:model.defer="number_phone" class="my-2"/>
            <x-input label="Valor" placeholder="Valor" wire:model.defer="value" class="my-2"/>
            <x-input label="Forma de Pagamento" placeholder="Forma de Pagamento" wire:model.defer="payment_method" class="my-2"/>
            <x-input label="Local" placeholder="Local" wire:model.defer="local" class="my-2"/>
            <x-input label="Entrega" placeholder="Entrega" wire:model.defer="delivery" class="my-2"/>
    
           
            <x-button type="submit" icon="pencil" primary label="Cadastrar" class="my-2"/>
        </form>
    </x-card>
</div>