<x-card title="Deletar Produto">
<div class="content-confirmed-action">
    <div class="icon">
        <svg aria-hidden="true" class=" w-14 h-14 mx-auto mb-4 text-red-400 dark:text-red-200" fill="none"
            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    </div>
    <div class="title text-2xl font-bold text-gray-700 text-center">
        <h3>Are you sure you want to delete <span
                class=" text-red-400 w-10 h-10 dark:text-red-200">{{$product->name}}</span> ?</h3>
    </div>
    <div class="footer flex justify-between mt-8">
    <x-button label="Yes, I'm sure" outline negative md right-icon="trash" wire:click="delete" />
    <x-button label="No, Cancel" outline positive md right-icon="badge-check" wire:click="$emit('closeModal')"/>
        
    </div>
</div>
</x-card>