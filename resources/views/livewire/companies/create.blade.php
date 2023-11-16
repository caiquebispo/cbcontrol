<div>
    <x-button label="Cadastrar Empresa" primary md icon="plus-circle" wire:click="$toggle('showModal','true')"/>
    <x-modal.main :title="'Cadastrar Empresa'" :show="$showModal">
        <x-slot:body>
            <form wire:submit.prevent="create" class="my-2">
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6 my-3">
                    <div>
                        <x-input label="Razão Social" placeholder="Razão Social" wire:model.defer="corporate_reason" />
                    </div>
                    <div>
                        <x-input label="CNPJ" placeholder="CNPJ" wire:model.defer="cnpj" />
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6 my-3">
                    <div>
                        <x-input label="Estado de Registro" placeholder="Estado de Registro" wire:model.defer="state_registration" />
                    </div>
                    <div>
                        <x-input label="Data de Fundação" placeholder="Data de Fundação" type="date" wire:model.defer="foundation_date" />
                    </div>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6 my-3">
                    <div>
                        <x-input label="E-mail" placeholder="E-mail" wire:model.defer="email" />
                    </div>
                    <div>
                        <x-input label="Telefone/WhatsApp" placeholder="Telefone/WhatsApp"  wire:model.defer="phone" />
                    </div>
                    <div>
                        <x-input label="Site" placeholder="Site"  wire:model.defer="site" />
                    </div>
                </div>      
                <x-button type="submit" primary label="Cadastrar" class="my-2" />
            </form>
        </x-slot:body>
    </x-modal.main>
</div>