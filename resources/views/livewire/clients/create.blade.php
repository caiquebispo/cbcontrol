<div class="max-w-7xl mx-auto">
    <x-card title="Create new Client">
        <x-errors />
        <form wire:submit.prevent="create" class="my-2">
            @csrf
            <x-native-select class="my-2"
                label="Select Type Group Client"
                placeholder="Select one status"
                :options="$groups"
                option-label="name"
                option-value="id"
                wire:model="group_id"
            />
            <x-input label="Full name" placeholder="Full name" wire:model.defer="name" class="my-2"/>
            <x-input label="Number Phone" placeholder="Number Phone" wire:model.defer="number_phone" class="my-2"/>
            <x-input label="Number P. Alternative" placeholder="Number P. Alternative" wire:model.defer="number_phone_alternative" class="my-2"/>
            <x-input label="CPF" placeholder="CPF" wire:model.defer="cpf" class="my-2"/>
            <x-input label="Birthday" placeholder="Birthday" wire:model.defer="birthday" class="my-2"/>
            
            <x-button type="submit" icon="pencil" primary label="CREATE" class="my-2"/>
        </form>
    </x-card>
</div>