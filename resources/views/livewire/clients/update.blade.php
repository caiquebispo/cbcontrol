<div class="max-w-7xl mx-auto">
    <x-card title="Atualizar Cliente">
        <x-errors />
        <form wire:submit.prevent="update" class="my-2">
            @csrf
            <x-native-select class="my-2"
                label="Selecione um grupo para ao cliente"
                placeholder="Selecionar grupo"
                :options="$groups"
                option-label="name"
                option-value="id"
                wire:model="group_id"
            />
            <div class="grid md:grid-cols-3 md:gap-6 my-3">
                <div>
                    <x-input label="Nome Completo" placeholder="Nome Completo" wire:model.defer="client.full_name"/>
                </div>
                <div>
                    <x-input label="Nª Telefone" placeholder="Nª Telefone" wire:model.defer="client.number_phone"/>
                </div>
                <div>
                    <x-input label="Data de Aniversário" type="date" placeholder="Data de Aniversário" wire:model.defer="client.birthday" />
                </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6 my-3">
                <div>
                    <x-input label="Valor" placeholder="Valor" wire:model.defer="client.value"/>
                </div>
                <div>
                    <x-input label="Forma de Pagamento" placeholder="Forma de Pagamento" wire:model.defer="client.payment_method"/>
                </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6 my-3">
                <div>
                    <x-input label="Local" placeholder="Local" wire:model.defer="client.local" class="my-2"/>
                </div>
                <div>
                    <x-input label="Entrega" placeholder="Entrega" wire:model.defer="client.delivery" class="my-2"/>
                </div>
            </div>
            <x-button type="submit" icon="pencil" primary label="ATUALIZAR" class="my-2"/>
        </form>
    </x-card>
</div>
