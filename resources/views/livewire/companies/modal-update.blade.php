<div>
    <x-button-update wire:click="$toggle('showModal', 'true')" />
    <x-modal.main :title="'Editar Grupo'" :show="$showModal">
        <x-slot:body>
            <form wire:submit.prevent="update" class="my-2">
                @csrf
            <div class="grid md:grid-cols-2 md:gap-6 my-3">
                <div>
                    <x-input label="Razão Social" placeholder="Razão Social" wire:model.defer="company.corporate_reason" />
                </div>
                <div>
                    <x-input label="CNPJ" placeholder="CNPJ" wire:model.defer="company.cnpj" />
                </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6 my-3">
                <div>
                    <x-input label="Estado de Registro" placeholder="Estado de Registro" wire:model.defer="company.state_registration" />
                </div>
                <div>
                    <x-input label="Data de Fundação" placeholder="Data de Fundação" type="date" wire:model.defer="company.foundation_date" />
                </div>
            </div>
            <div class="grid md:grid-cols-3 md:gap-6 my-3">
                <div>
                    <x-input label="E-mail" placeholder="E-mail" wire:model.defer="company.email" />
                </div>
                <div>
                    <x-input label="Telefone/WhatsApp" placeholder="Telefone/WhatsApp"  wire:model.defer="company.phone" />
                </div>
                <div>
                    <x-input label="Site" placeholder="Site"  wire:model.defer="company.site" />
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
                    wire:model="company.status"
                />

                <x-button type="submit" icon="pencil" primary label="Atualizar" />
            </form>
        </x-slot:body>
    </x-modal.main>
</div>
