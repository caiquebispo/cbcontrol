<div class="max-w-7xl mx-auto">
    <x-card title="Acréscimo / Decréscimo">
        <x-errors />
        <form wire:submit.prevent="update" class="my-2">
            @csrf
            <x-native-select
                label="Adicionar acréscimo / decréscimo"
                placeholder="Adicionar acréscimo / decréscimo"
                :options="[
                    ['name' => 'Increase',  'value' => 1],
                    ['name' => 'Decrease', 'value' => 0],
                ]"
                option-label="name"
                option-value="value"
                wire:model="type_increase_or_decrease"
            />
            <x-input label="Valor" placeholder="Valor" wire:model.defer="value" class="my-2"/>
            
            
            <x-button type="submit" icon="pencil" primary label="Acre/ Decr" class="my-2"/>
        </form>
    </x-card>
</div>