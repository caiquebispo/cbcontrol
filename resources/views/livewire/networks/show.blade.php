<div class="mr-4">
    <x-button-show wire:click="$toggle('showModal', 'true')" />
    <x-modal.main :title="'Visualizar Rede'" :show="$showModal" size="lg">
        <x-slot:body>
            Hello
        </x-slot:body>
    </x-modal.main>
</div>
