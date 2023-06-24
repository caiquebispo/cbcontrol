<x-app-layout>
    <div class="py-24">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:companies.upload-photo />
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg my-5">
                <div>
                    <livewire:companies.update/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>