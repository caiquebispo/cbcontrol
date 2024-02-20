<div>
    <x-button label="Cad Despesa" negative md icon="plus-circle" wire:click="$toggle('showModal', 'true')" />
    <x-modal.main :title="'Cad Despesa'" :show="$showModal" size="lg">
        <x-slot:body>


        </x-slot:body>
    </x-modal.main>
</div>
