<x-app-layout>
    <div class="py-24">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <header class="mb-5">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Upload de Imagens') }}
                    </h2>
                </header>
                <div class="max-w-xl">
                    <livewire:companies.upload-photo />
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg my-5">
               <header class="mb-5">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Informações da empresa') }}
                    </h2>
                </header>
                <div>
                    <livewire:companies.update/>
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg my-5">
               <header class="mb-5">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex justify-between">
                        {{ __('Informações de Endereço') }}
                        <x-button icon="pencil" primary label="CADASTRAR ENDEREÇO"  onclick="Livewire.emit('openModal', 'companies.create-address')" class="my-2"/>
                    </h2>
                    <livewire:companies.update-address />
                </header>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg my-5">
                <livewire:settings-company.settings />
            </div>
        </div>
    </div>
</x-app-layout>
