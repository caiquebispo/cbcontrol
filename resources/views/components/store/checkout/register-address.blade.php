{{--<!-- Etapa 4: Coleta das informações de endereço -->--}}
{{--<h2 class="text-2xl font-bold mb-4">Informações de Endereço</h2>--}}
{{--<div class="bg-white p-4 rounded shadow">--}}
{{--    <div class="mb-4">--}}
{{--        <label class="block text-gray-700 text-sm font-bold mb-2" for="city">--}}
{{--            Cidade--}}
{{--        </label>--}}
{{--        <input wire:model="address.city" type="text" id="city" class="form-input rounded-md shadow-sm">--}}
{{--        @error('address.city') <span class="text-red-500">{{ $message }}</span> @enderror--}}
{{--    </div>--}}
{{--    <div class="mb-4">--}}
{{--        <label class="block text-gray-700 text-sm font-bold mb-2" for="cep">--}}
{{--            CEP--}}
{{--        </label>--}}
{{--        <input wire:model="address.cep" type="text" id="cep" class="form-input rounded-md shadow-sm">--}}
{{--        @error('address.cep') <span class="text-red-500">{{ $message }}</span> @enderror--}}
{{--    </div>--}}
{{--    <div class="mb-4">--}}
{{--        <label class="block text-gray-700 text-sm font-bold mb-2" for="neighborhood">--}}
{{--            Bairro--}}
{{--        </label>--}}
{{--        <input wire:model="address.neighborhood" type="text" id="neighborhood" class="form-input rounded-md shadow-sm">--}}
{{--        @error('address.neighborhood') <span class="text-red-500">{{ $message }}</span> @enderror--}}
{{--    </div>--}}
{{--    <div class="mb-4">--}}
{{--        <label class="block text-gray-700 text-sm font-bold mb-2" for="street">--}}
{{--            Rua--}}
{{--        </label>--}}
{{--        <input wire:model="address.street" type="text" id="street" class="form-input rounded-md shadow-sm">--}}
{{--        @error('address.street') <span class="text-red-500">{{ $message }}</span> @enderror--}}
{{--    </div>--}}
{{--    <div class="mb-4">--}}
{{--        <label class="block text-gray-700 text-sm font-bold mb-2" for="number">--}}
{{--            Número--}}
{{--        </label>--}}
{{--        <input wire:model="address.number" type="text" id="number" class="form-input rounded-md shadow-sm">--}}
{{--        @error('address.number') <span class="text-red-500">{{ $message }}</span> @enderror--}}
{{--    </div>--}}
{{--    <div class="mb-4">--}}
{{--        <label class="block text-gray-700 text-sm font-bold mb-2" for="proximity">--}}
{{--            Próximo a--}}
{{--        </label>--}}
{{--        <input wire:model="address.proximity" type="text" id="proximity" class="form-input rounded-md shadow-sm">--}}
{{--        @error('address.proximity') <span class="text-red-500">{{ $message }}</span> @enderror--}}
{{--    </div>--}}
{{--</div>--}}
<div class="max-w-7xl mx-auto">
    <x-card title="Informações do endereço">
        <x-errors />
        <form wire:submit.prevent="create" class="my-2">
            @csrf
            <div class="grid md:grid-cols-3 md:gap-6 my-3">
                <div>
                    <x-input label="Estado" placeholder="Estado" wire:model.defer="address.states"/>
                </div>
                <div>
                    <x-input label="CEP" placeholder="CEP" wire:model.defer="address.zipe_code" />
                </div>
                <div>
                    <x-input label="Cidade"  placeholder="Cidade" wire:model.defer="address.city" />
                </div>
            </div>
            <div class="grid md:grid-cols-3 md:gap-6 my-3">
                <div>
                    <x-input label="Bairro" placeholder="Bairro" wire:model.defer="address.neighborhood"/>
                </div>
                <div>
                    <x-input label="Rua" placeholder="Rua" wire:model.defer="address.road" />
                </div>
                <div>
                    <x-input label="Nª Da Casa"  placeholder="Nª Da Casa" wire:model.defer="address.number" />
                </div>
            </div>
            <div class="grid md:grid-cols-1 md:gap-6 my-3">

                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Complemento</label>
                <textarea wire:model.defer="address.complement" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""></textarea>
            </div>
        </form>
    </x-card>
</div>
