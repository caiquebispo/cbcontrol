<div>
    <x-button label="Receber PG" positive md icon="plus-circle" wire:click="$toggle('showModal', 'true')" />
    <x-modal.main :title="'Receber PG'" :show="$showModal" size="lg">
        <x-slot:body>
            <livewire:clients.list-client :key="now()->timestamp" />
        </x-slot:body>
    </x-modal.main>

</div>
