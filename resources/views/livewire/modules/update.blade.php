<div>
    <x-button-update wire:click="$toggle('showModal', 'true')" />
    <x-modal.main :title="'Editar Módulo ou Permissão'" :show="$showModal">
        <x-slot:body>
            <form wire:submit.prevent="update" class="my-2">
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6 my-3">
                    <div>
                        <x-input label="Menu Name" placeholder="Menu Name" type="text" wire:model.defer="module.menu_name" />
                    </div>
                    <div>
                        <x-input label="Nome" placeholder="Nome" type="text" wire:model.defer="module.name" />
                    </div>
                    
                </div>
                <div class="grid md:grid-cols-2 md:gap-6 my-3">
                    <div>
                        <x-input label="URL" placeholder="URL" type="text" wire:model.defer="module.url" />
                    </div>
                    <div>
                        <x-input label="Label" placeholder="Label" type="text" wire:model.defer="module.label" />
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6 my-3">
                    <div>
                        <x-input label="ICONE" placeholder="ICONE" type="text" wire:model.defer="module.icon_class" />
                    </div>
                    <div>
                        <x-input label="Orde de exibição" placeholder="Orde de exibição" type="number" wire:model.defer="module.order_list" />
                    </div>
                    <x-native-select
                        label="È um módulo?"
                        placeholder="È um módulo?"
                        :options="[
                            ['is_module' => 'Sim',  'value' => 1],
                            ['is_module' => 'Não', 'value' => 0],
                        ]"
                        option-label="is_module"
                        option-value="value"
                        wire:model="module.is_module"
                    />
                </div>

                <x-button type="submit" primary label="Editar"/>
            </form>
        </x-slot:body>
    </x-modal.main>
</div>
