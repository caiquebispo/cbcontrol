<div class="max-w-7xl mx-auto">
    <x-card title="Increase and/or Decrease">
        <x-errors />
        <form wire:submit.prevent="update" class="my-2">
            @csrf
            <x-native-select
                label="Select An Increase Or Decrease"
                placeholder="Select An Increase Or Decrease"
                :options="[
                    ['name' => 'Increase',  'value' => 1],
                    ['name' => 'Decrease', 'value' => 0],
                ]"
                option-label="name"
                option-value="value"
                wire:model="type_increase_or_decrease"
            />
            <x-input label="Value" placeholder="Value" wire:model.defer="value" class="my-2"/>
            
            
            <x-button type="submit" icon="pencil" primary label="Incr/ Decr" class="my-2"/>
        </form>
    </x-card>
</div>