<x-app-layout>

    <div class="py-24">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button class="export flex text-green-600 mb-4">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16">
                            <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z"/>
                          </svg>
                    </button>
                    <livewire:clients.list-clients />
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/exportFileExcel.js')}}"></script>
</x-app-layout>
