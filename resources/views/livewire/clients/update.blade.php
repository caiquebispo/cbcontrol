<div class="max-w-7xl mx-auto">
    <x-card title="Update Client:">
        <x-errors />
        <form wire:submit.prevent="update" class="my-2">
            @csrf
            <x-native-select class="my-2"
                label="Select Type Group Client"
                placeholder="Select one status"
                :options="$groups"
                option-label="name"
                option-value="id"
                wire:model="group_id"
            />
            <x-input label="Full name" placeholder="Full name" wire:model.defer="full_name" class="my-2"/>
            <x-input label="Number Phone" placeholder="Number Phone" wire:model.defer="number_phone" class="my-2"/>
            <x-input label="Number P. Alternative" placeholder="Number P. Alternative" wire:model.defer="value" class="my-2"/>
            <x-input label="CPF" placeholder="CPF" wire:model.defer="payment_method" class="my-2"/>
            <x-input label="Birthday" placeholder="Birthday" wire:model.defer="local" class="my-2"/>
            <x-input label="Birthday" placeholder="Birthday" wire:model.defer="delivery" class="my-2"/>
            
            <x-button type="submit" icon="pencil" primary label="UPDATE" class="my-2"/>
        </form>
    </x-card>
</div>