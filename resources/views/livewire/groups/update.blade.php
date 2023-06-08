<x-card title="Update Group">
    <x-errors />
    <form wire:submit.prevent="update" class="my-2">
        @csrf
        <div class="mb-6">
            <x-input label="Name" wire:model.defer="group.name">
                <x-slot name="append">
                    <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                        <x-button class="h-full rounded-r-md" icon="sort-ascending" primary flat squared />
                    </div>
                </x-slot>
            </x-input>
        </div>

        <x-button type="submit" icon="pencil" primary label="CREATE" />
    </form>
</x-card>