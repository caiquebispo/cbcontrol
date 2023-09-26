<div>
    <x-button-update wire:click="$toggle('showModal', 'true')" />
    <x-modal.main :title="'Editar Rede'" :show="$showModal" size="lg">
        <x-slot:body>
            Hello
        </x-slot:body>
    </x-modal.main>
</div>
