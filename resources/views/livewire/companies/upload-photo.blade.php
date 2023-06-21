<div>
   <form wire:submit.prevent="save">
    @if ($photo)
        Photo Preview:
        <img src="{{ $photo->temporaryUrl() }}" class="w-12 w-12">
    @endif
 
    <input type="file" wire:model="photo">
 
    @error('photo') <span class="error">{{ $message }}</span> @enderror
 
    <x-primary-button class="ml-3">
                {{ __('Salvar Imagem') }}
    </x-primary-button>
</form>
</div>
