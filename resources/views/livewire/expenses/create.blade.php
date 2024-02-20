<div>
    <x-button label="Cad Despesa" negative md icon="plus-circle" wire:click="$toggle('showModal', 'true')" />
    <x-modal.main :title="'Cad Despesa'" :show="$showModal" size="lg">
        <x-slot:body>
            <form wire:submit.prevent="create" class="my-2">
                @csrf

                <div class="grid md:grid-cols-3 md:gap-6 my-3">
                    <div>
                        <x-input label="Nome" placeholder="Nome" wire:model.defer="name" />
                    </div>
                    <div>
                        <x-input label="Valor" placeholder="Valor" wire:model.defer="value" />
                    </div>
                    <div>
                        <x-input label="Quantidade" placeholder="Quantidade" wire:model.defer="quantity" />
                    </div>
                </div>
                <x-button type="submit" icon="pencil" primary label="Cadastrar" class="my-2" />
            </form>
        </x-slot:body>
    </x-modal.main>
</div>
