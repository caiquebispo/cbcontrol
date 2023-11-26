<div>
    @if($has_relationship)
        <x-bi-trash class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer w-6 h-6" wire:click.prevent="detach"/>
    @else
        <x-bi-plus-circle class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer w-6 h-6" wire:click.prevent="attach"/>
    @endif
</div>
