<div>
    <x-button-hav wire:click="$toggle('showModal', 'true')" class="text-blue-300" />
    <x-modal.main :title="'Adicionar HAV'" :show="$showModal">
        <x-slot:body>
            <form wire:submit.prevent="received" class="my-2">
                @csrf
                <x-input label="Valor" placeholder="Valor" wire:model.defer="value" />
                <x-button type="submit" icon="pencil" primary label="Adicionar" class="my-2" />
            </form>
        </x-slot:body>

    </x-modal.main>
</div>
