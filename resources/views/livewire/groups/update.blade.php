<div class="mb-4">
    {{-- <button wire:click="$emit('openModal', 'groups.create')">Edit User</button --}} <form
        wire:submit.prevent="update">
    @csrf
    <div class="mb-6">
        <x-label for="name" :value="__('Nome do Grupo')" />
        <x-input id="name" wire:model.defer="name" class="block mt-1 w-full" type="text" name="name" />
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>

    <x-button class="mt-4">
        {{ __('Update') }}
    </x-button>
    </form>

</div>