@props(['nameButton' => null, 'modelExport' => null, 'showButtonExport' => false])

<div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
    <div class="w-full flex md:w-1/2">
        <x-select
            class="mr-2"
            placeholder="Itens por pagina"
            :options="[
                ['name' => '10',  'id' => 10],
                ['name' => '20', 'id' => 20],
                ['name' => '50',   'id' => 50],
                ['name' => '100',    'id' => 100],
            ]"
            option-label="name"
            option-value="id"
            wire:model="qtyItemsForPage"
        />
        <form class="flex items-center w-full">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input wire:model="search" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
            </div>
        </form>
    </div>
    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
        {{$buttonCreate}}
        @if($showButtonExport)
            <div class="flex items-center space-x-3 w-full md:w-auto">
                <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                    <x-bi-chevron-down class="mr-2"/>
                    EXPORTA
                </button>
                <div id="actionsDropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">

                    <div class="py-1">
                        <a href="#" class="block py-2 px-4  hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" wire:click="exportPDF('{{$modelExport}}')">
                            <p class="flex justify-center">
                                Download - <x-bi-file-earmark-pdf class="ml-1 text-red-600 w-5 h-5"/>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

