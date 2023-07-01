<div class="max-w-7xl mx-auto">
    <x-card title="Cadastrar Endereço">
        <x-errors />
        <form wire:submit.prevent="create" class="my-2">
            @csrf
            <div class="grid md:grid-cols-3 md:gap-6 my-3">
                <div>
                    <x-input label="Estado" placeholder="Estado" wire:model.defer="states"/>
                </div>
                <div>
                    <x-inputs.maskable mask="#####-###" label="CEP" placeholder="CEP" wire:model.defer="zipe_code" />
                </div>
                <div>
                    <x-input label="Cidade"  placeholder="Cidade" wire:model.defer="city" />
                </div>
            </div>
            <div class="grid md:grid-cols-3 md:gap-6 my-3">
                <div>
                    <x-input label="Bairro" placeholder="Bairro" wire:model.defer="neighborhood"/>
                </div>
                <div>
                    <x-input label="Rua" placeholder="Rua" wire:model.defer="road" />
                </div>
                <div>
                    <x-input label="Nª Da Casa"  placeholder="Nª Da Casa" wire:model.defer="number" />
                </div>
            </div>
            <div class="grid md:grid-cols-1 md:gap-6 my-3">
               
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complemento</label>
                <textarea wire:model.defer="complement" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""></textarea>

            </div>
            
            <x-button type="submit" icon="pencil" primary label="CADASTRAR" class="my-2"/>
        </form>
    </x-card>
</div>
