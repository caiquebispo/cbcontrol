<section class="footer bg-slate-150 mt-6 border border-gray-300 p-2 rounded-lg">
    <div class="grid md:grid-cols-3 md:gap-6 my-3">
        <button type="button" class="bg-green-300 text-green-600 text-lg p-2 rounded-md"
            wire:click="finish">Finalizar</button>
        <button type="button" class="bg-red-300 text-red-600 text-lg p-2 rounded-md"
            wire:click="clearCart">Cancelar</button>
        <button type="button" class="bg-blue-300 text-blue-600 text-lg p-2 rounded-md"
            wire:click="exportSummarySales">Baixar Relatório</button>
    </div>
</section>
