@if($canShowModal)
    <x-modal>
        <x-slot name="title">Atualizar Grupo ({{$selectedItems->name}})</x-slot>
        <x-slot name="body">
            <form wire:submit.prevent="update">
                @csrf
                <div class="mb-6">
                    <x-label for="name" :value="__('Nome do Grupo')" />
                    <x-input id="name" wire:model.defer="name" class="block mt-1 w-full" type="text" name="name" value=""/>
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>
                <x-button class="mt-4">
                    {{ __('Editar') }}
                </x-button>
            </form>
        </x-slot>
    </x-modal>
    @endif
    <script>
        document.addEventListener('livewire:load', function () {
            $('#name').on('click', function(e){
                $(this).attr('value', 'asds')
            });
        })
    </script>