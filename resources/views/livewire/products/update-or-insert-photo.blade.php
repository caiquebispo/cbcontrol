<x-card title="Adicionar e/ou remove images de produto">
    <div class="w-full">
        <form wire:submit.prevent="save" class="w-full">
            <div class="grid md:grid-cols-2 md:gap-6 my-3">
                <div>
                    <input type="file" wire:model="photos" multiple class="my-4">

                    @error('photos.*') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class=" flex items-center">
                    <x-primary-button class="w-full">
                        {{ __('Salvar Imagem') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
    
        <livewire:products.list-photos :product="$product" />
    
</x-card>