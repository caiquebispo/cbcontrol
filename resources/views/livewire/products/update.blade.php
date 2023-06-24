<div class="max-w-7xl mx-auto">
    <x-card title="Cadastrar Produto">
        <x-errors />
        <form wire:submit.prevent="update" class="my-2">
            @csrf
            <x-native-select class="my-2"
                label="Selecione uma categoria"
                placeholder="Selecionar categoria"
                :options="$categories"
                option-label="name"
                option-value="id"
                wire:model="product.category_id"
            />
            <div class="grid md:grid-cols-3 md:gap-6 my-3">
                <div>
                    <x-input label="Nome" placeholder="Nome" wire:model.defer="product.name"/>
                </div>
                <div>
                    <x-input label="Preço" placeholder="Preço" wire:model.defer="product.price"/>
                </div>
                <div>
                    <x-input label="Quantidade" placeholder="Quantidade" wire:model.defer="product.quantity"/>
                </div>
            </div>
            <div class="grid md:grid-cols-1 md:gap-6 my-3">
               
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                <textarea wire:model.defer="product.description" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""></textarea>

            </div>
            <x-button type="submit" icon="pencil" primary label="Atualizar" class="my-2"/>
        </form>
    </x-card>
</div>