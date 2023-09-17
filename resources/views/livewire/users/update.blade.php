<div>
    <x-button-update wire:click="$toggle('showModal', 'true')" />
    <x-modal.main :title="'Editar Usuário'" :show="$showModal">
        <x-slot:body>
            <form wire:submit.prevent="update" class="my-2">
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6 my-3">
                    <div>
                        <x-input label="Nome" placeholder="Nome" wire:model.defer="user.name" />
                    </div>
                    <div>
                        <x-input label="E-mail" type="email" placeholder="E-mail" wire:model.defer="user.email" />
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6 my-3">
                    <div>
                        <x-input label="Telefone" placeholder="Telefone" wire:model.defer="user.number_phone" />
                    </div>
                    <div>
                        <x-input label="Data de Aniversário" type="date" placeholder="Data de Aniversário" wire:model.defer="user.birthday" />
                    </div>
                </div>
                <x-native-select
                    label="Status"
                    placeholder="Status"
                    :options="[
                    ['status' => 'Ativo',  'value' => 1],
                    ['status' => 'Inativo', 'value' => 0],
                ]"
                    option-label="status"
                    option-value="value"
                    wire:model="user.status"
                />
                <x-button type="submit"  primary label="Atualizar" class="my-2" />
            </form>
        </x-slot:body>
    </x-modal.main>
</div>
