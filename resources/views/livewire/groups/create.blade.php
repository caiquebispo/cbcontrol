<div>
    <x-button wire:click="$toggle('canShowModal', 'true')">

        {{ __('Criar novo Grupo') }}
    </x-button>
    @if($canShowModal)
    <x-modal>
        <x-slot name="title">Criar novo Grupo</x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="create">
                @csrf
                <div class="mb-6">
                    <x-label for="name" :value="__('Nome do Grupo')" />
                    <x-input id="name" wire:model.defer="name" class="block mt-1 w-full" type="text" name="name" />
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>
                
                <x-button class="mt-4">
                    {{ __('Criar') }}
                </x-button>
            </form>
        </x-slot>
    </x-modal>
    @endif
</div>