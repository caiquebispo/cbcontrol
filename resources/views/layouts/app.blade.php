<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head class="dark">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{url('img/logo/cb-logo.png')}}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Scripts -->
    <wireui:scripts />
    @livewireScripts
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{--livewire --}}
    @livewireStyles

    @yield('style')
    {{-- dependece dateRangerPicker --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
</head>

<body class="font-sans antialiased">
    <x-nav-bar>
        <livewire:utils.update-company />
        <livewire:megaphone></livewire:megaphone>
        <x-toggle-dark-mode />
        <div class="flex items-center ml-3">
            <x-dropdown-toggle-user />
        </div>
    </x-nav-bar>
    <x-aside>
        <x-info-company />

        <ul class="space-y-2 font-medium">
            <li>

                <a @if(isset(auth()->user()->company)) href="{{url("/store/".auth()->user()->company->settings->slung)}}" @endif target="_blank"  class="flex items-center p-2 text-green-900 rounded-lg dark:text-white group">
                   <svg class="animate-bounce flex-shrink-0 w-5 h-5 text-green-500 transition duration-75 dark:text-green-400 group-hover:text-green-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                      <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                   </svg>
                   <span class="flex-1 ml-3 whitespace-nowrap text-green-500 rounded-lg dark:text-white">Ver loja online</span>
                </a>
             </li>
            <li class="hidden">
                <a href="{{route('dashboard')}}"
                    class="flex items-center p-2 text-gray-500 text-sm rounded-lg dark:text-white bg-gray-950   hover:text-gray-200 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin text-green-500" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                    </svg>
                    <span class="ml-3">PDV</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard')}}"
                    class="flex items-center p-2 text-gray-500 text-sm rounded-lg dark:text-white hover:bg-gray-950  hover:text-gray-200 dark:hover:bg-gray-700">
                    <svg aria-hidden="true"
                        class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-500 text-sm dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Painel de Controle</span>
                </a>
            </li>
             <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg group hover:bg-gray-950 hover:text-gray-200 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-product" data-collapse-toggle="dropdown-product">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket-fill w-6 h-6" viewBox="0 0 16 16">
                        <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z"/>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Produtos</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                     </svg>

                </button>
                <ul id="dropdown-product" class="hidden py-2 space-y-2">
                    <li class="list-disc">
                        <a href="{{route('categories.list')}}"
                            class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg pl-11 group hover:text-blue-600 dark:text-white dark:hover:bg-gray-700">Categoria</a>
                    </li>
                    <li>
                        <a href="{{route('products.list')}}"
                            class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg pl-11 group hover:text-blue-600 dark:text-white dark:hover:bg-gray-700">Produto</a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button"
                        class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg group hover:bg-gray-950 hover:text-gray-200 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-sales" data-collapse-toggle="dropdown-sales">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket-fill w-6 h-6" viewBox="0 0 16 16">
                        <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z"/>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Vendas</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>

                </button>
                <ul id="dropdown-sales" class="hidden py-2 space-y-2">

                    <li>
                        <a href="{{route('sales.list')}}"
                           class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg pl-11 group hover:text-blue-600 dark:text-white dark:hover:bg-gray-700">Todas as Vendas</a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg group hover:bg-gray-950  hover:text-gray-200 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-client" data-collapse-toggle="dropdown-client">
                    <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-people-fill w-6 h-6"
                        viewBox="0 0 16 16">
                        <path
                            d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Clientes</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                     </svg>
                </button>
                <ul id="dropdown-client" class="hidden py-2 space-y-2">
                    <li  class="list-disc">
                        <a href="{{route('groups')}}"
                            class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg pl-11 group hover:text-blue-600 dark:text-white dark:hover:bg-gray-700">Grupos</a>
                    </li>
                    <li  class="list-disc">
                        <a href="{{route('clients')}}"
                            class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg pl-11 group hover:text-blue-600 dark:text-white dark:hover:bg-gray-700">Clientes</a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg group hover:bg-gray-950 hover:text-gray-200 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-company" data-collapse-toggle="dropdown-company">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-gear-fill w-6 h-6" viewBox="0 0 16 16">
                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                      </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Configurações</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                     </svg>
                </button>
                <ul id="dropdown-company" class="hidden py-2 space-y-2">
                    <li class="list-disc">
                        <a href="{{route('users.list')}}"
                            class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg pl-11 group hover:text-blue-600 dark:text-white dark:hover:bg-gray-700">Usuários</a>
                    </li>
                    <li>
                        <a href="{{route('company.update')}}"
                            class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg pl-11 group hover:text-blue-600 dark:text-white dark:hover:bg-gray-700">Empresa</a>
                    </li>
                </ul>
            </li>
        </ul>

    </x-aside>
     <x-notifications />
    <!-- Page Content -->

    <div class="p-4 sm:ml-64 min-h-screen bg-gray-100 dark:bg-gray-900">

        {{ $slot }}
    </div>

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>


        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="{{asset('js/darkMode.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        @yield('script')
</body>

</html>
