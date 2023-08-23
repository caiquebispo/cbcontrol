<x-app-layout>

    <div class="py-24">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <x-button class="export flex bg-green-400 text-white hover:bg-green-600 mb-4" href="{{route('exportPDF')}}">
                EXPORT PDF
            </x-button>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <livewire:clients.list-clients />
                </div>
            </div>
        </div>
    </div>
{{--    <script src="{{asset('js/exportFileExcel.js')}}"></script>--}}
</x-app-layout>
