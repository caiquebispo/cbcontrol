<div>
    <header class="mb-5">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex justify-between">
            {{ __('Configurações da Empresa') }}
            <x-button icon="trash" negative label="DESFAZER SELEÇÃO DE CORES" wire:click="toCleanPaletteColors" class="my-2" />
        </h2>
    </header>


    <x-errors />
    <form wire:submit.prevent="update" class="my-2">
        @csrf
        <div class="grid md:grid-cols-2 md:gap-6 my-3">

            <x-input disabled label="Slug" placeholder="Slug" wire:model.defer="settings.slung" />
            @can('can-set-mode-demo')
            <div>
                <x-native-select label="Modo Demo?" :options="[
                    ['is_test_mode' => 'Sim',  'value' => 1],
                    ['is_test_mode' => 'Não', 'value' => 0],
                ]" option-label="is_test_mode" option-value="value" wire:model.defer="settings.is_test_mode" />
            </div>
            @endcan
        </div>
        <div class="grid md:grid-cols-3 md:gap-6 my-3">
            <div>
                <x-native-select label="A loja está aberta?" :options="[
                    ['is_opened' => 'Sim',  'value' => 1],
                    ['is_opened' => 'Não', 'value' => 0],
                ]" option-label="is_opened" option-value="value" wire:model.defer="settings.is_opened" />
            </div>
            <div>
                <x-native-select label="A loja tem delivry?" :options="[
                    ['has_delivery' => 'Sim',  'value' => 1],
                    ['has_delivery' => 'Não', 'value' => 0],
                ]" option-label="has_delivery" option-value="value" wire:model.defer="settings.has_delivery" />
            </div>
            <div>
                <x-input label="Valor do Delivery" placeholder="R$ 4.99" wire:model.defer="settings.delivery_price" />
            </div>
        </div>
        <div class="grid md:grid-cols-3 md:gap-6 my-3">
            <div>
                <x-input type="color" label="Cor primaria" wire:model.defer="settings.primary_color" />
            </div>
            <div>
                <x-input type="color" label="Cor secundaria" wire:model.defer="settings.second_color" />
            </div>
            <div>
                <x-input type="color" label="Cor da fonte" wire:model.defer="settings.font_color" />
            </div>
        </div>
        <x-button type="submit" icon="pencil" primary label="ATULIZAR" class="my-2" />
    </form>
</div>