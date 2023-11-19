<div>
    <x-button-trash wire:click="$toggle('showModal', 'true')" />
    <x-modal.delete :show="$showModal" typeModelDelete="o módulo/permissão" />
</div>
