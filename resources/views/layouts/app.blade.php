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
            @can('can-access-online-store')
            <li>

                <a @if(isset(auth()->user()->company)) href="{{url("/store/".auth()->user()->company->settings->slung)}}" @endif target="_blank"  class="flex items-center p-2 text-green-900 rounded-lg dark:text-white group">
                   <svg class="animate-bounce flex-shrink-0 w-5 h-5 text-green-500 transition duration-75 dark:text-green-400 group-hover:text-green-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                      <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                   </svg>
                   <span class="flex-1 ml-3 whitespace-nowrap text-green-500 rounded-lg dark:text-white">Ver loja online</span>
                </a>
             </li>
             @endcan
            @foreach(auth()->user()->getMenu() as $key_menu => $menu)
             <li x-data="{ open: false }">
                
                <button type="button"
                    x-on:click="open = ! open"
                    class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg group hover:bg-gray-950 hover:text-gray-200 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-{{$key_menu}}" data-collapse-toggle="dropdown-{{$key_menu}}">

                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>{{$menu['menu']}}</span>
                      <template x-if="open">
                         <x-bi-chevron-up />
                    </template>
                    <template x-if="!open">
                        <x-bi-chevron-down />
                    </template>
                </button>
                <ul id="dropdown-{{$key_menu}}" class="hidden py-2 space-y-2">
                    @foreach($menu['sub_menu'] as  $sub)
                    <li class="list-disc">
                        <a href="{{$sub['url']}}"
                            class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg pl-11 group hover:text-blue-600 dark:text-white dark:hover:bg-gray-700">{{$sub['name']}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
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
