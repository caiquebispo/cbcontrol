<div>
    <x-button label="Cadastrar Módulo ou Permissão" primary md icon="plus-circle" wire:click="$toggle('showModal','true')"/>
    <x-modal.main :title="'Cadastrar Módulo ou Permissão'" :show="$showModal">
        <x-slot:body>
            <form wire:submit.prevent="create" class="my-2">
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6 my-3">
                    <div>
                        <x-input label="Nome" placeholder="Nome" type="text" wire:model.defer="name" />
                    </div>
                    <div>
                        <x-input label="Label" placeholder="Label" type="text" wire:model.defer="label" />
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6 my-3">
                    <div>
                        <x-input label="URL" placeholder="URL" type="text" wire:model.defer="url" />
                    </div>
                    <div>
                        <x-input label="Menu Name" placeholder="Menu Name" type="text" wire:model.defer="menu_name" />
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6 my-3">
                    <div>
                        <x-input label="ICONE" placeholder="ICONE" type="text" wire:model.defer="icon_class" />
                    </div>
                    <div>
                        <x-input label="Orde de exibição" placeholder="Orde de exibição" type="number" wire:model.defer="order_list" />
                    </div>
                    <x-native-select
                        label="È um módulo?"
                        placeholder="Status"
                        :options="[
                            ['is_module' => 'Sim',  'value' => 1],
                            ['is_module' => 'Não', 'value' => 0],
                        ]"
                        option-label="is_module"
                        option-value="value"
                        wire:model="is_module"
                    />
                </div>

                <x-button type="submit" primary label="Cadastrar"/>
            </form>
        </x-slot:body>
    </x-modal.main>
</div>
