<div class="mb-4">
    <form wire:submit.prevent="create">
        @csrf
        <div class="mb-6">
            <x-label for="name" :value="__('Nome do Grupo')" />
            <x-input id="name" wire:model.defer="name" class="block mt-1 w-full" type="text" name="name" />
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <x-button class="mt-4">
            {{ __('Create') }}
        </x-button>
    </form>

</div>