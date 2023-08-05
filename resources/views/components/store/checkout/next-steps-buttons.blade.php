@props(['step'])

<div class="container mx-auto p-4 t-4 flex justify-between">
    @if ($step > 1 && $step < 5)
        <button wire:click="previousStep" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">Voltar</button>
    @endif
    @if ($step < 4)
        <button wire:click="nextStep" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">Avançar</button>
    @else
        <button wire:click="nextStep" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">Concluir Pedido</button>
    @endif
</div>
