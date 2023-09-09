<div>
    <x-button label="Acréscimo e/ou Decréscimo" primary md icon="plus-circle" wire:click="$toggle('showModal','true')"/>
    <x-modal.main :title="'Acréscimo e/ou Decréscimo'" :show="$showModal">
        <x-slot:body>
            <form wire:submit.prevent="update" class="my-2">
                @csrf
                <div class="grid md:grid-cols-2 md:gap-2 my-3">
                    <x-native-select
                        label="Adicionar acréscimo / decréscimo"
                        placeholder="Adicionar acréscimo / decréscimo"
                        :options="[
                            ['name' => 'Acréscimo',  'value' => 1],
                            ['name' => 'Decréscimo', 'value' => 0],
                        ]"
                        option-label="name"
                        option-value="value"
                        wire:model="type_increase_or_decrease"
                    />
                    <x-input label="Valor" placeholder="Valor" wire:model.defer="value" class="my-2"/>
                </div>
                <x-button type="submit" primary label="Aplicar" class="my-2"/>
            </form>
        </x-slot:body>
    </x-modal.main>
</div>
