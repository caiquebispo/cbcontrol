<div>
    <x-button-trash wire:click="$toggle('showModal', 'true')" />
    <x-modal.delete :show="$showModal" typeModelDelete="a empresa" />
</div>