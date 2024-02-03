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
                <a @if(isset(auth()->user()->company)) href="{{url("/store/".auth()->user()->company->settings->slung)}}" @endif target="_blank" class="flex items-center p-2 text-green-900 rounded-lg dark:text-white group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="animate-bounce flex-shrink-0 w-5 h-5 text-green-500 transition duration-75 dark:text-green-400 group-hover:text-green-900 dark:group-hover:text-white" viewBox="0 0 16 16">
                        <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap text-green-500 rounded-lg dark:text-white">Ver loja online</span>
                </a>
            </li>
            <li>
                <a href="{{route('boxfront')}}" target="_blank" class="flex items-center p-2 text-green-900 rounded-lg dark:text-white group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="animate-bounce flex-shrink-0 w-5 h-5 text-green-500 transition duration-75 dark:text-blue-400 group-hover:text-blue-900 dark:group-hover:text-white" viewBox="0 0 16 16">
                        <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0 14.5 0zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5M12 12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0M1.5 12h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0 1-.25-.25" />
                    </svg>

                    <span class="flex-1 ml-3 whitespace-nowrap text-green-500 rounded-lg dark:text-white">PDV</span>
                </a>
            </li>
            @endcan
            @foreach(auth()->user()->getMenu() as $key_menu => $menu)
            <li x-data="{ open: false }">

                <button type="button" x-on:click="open = ! open" class="flex items-center w-full p-4 text-gray-500 text-sm transition duration-75 rounded-md bg-gray-900 text-slate-300 group hover:bg-gray-950 hover:text-gray-200 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-{{$key_menu}}" data-collapse-toggle="dropdown-{{$key_menu}}">
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>{{$menu['menu']}}</span>
                    <template x-if="open">
                        <x-bi-chevron-up />
                    </template>
                    <template x-if="!open">
                        <x-bi-chevron-down />
                    </template>
                </button>
                <ul id="dropdown-{{$key_menu}}" class="hidden py-2 space-y-2">
                    @foreach($menu['sub_menu'] as $sub)
                    <li class="list-disc">
                        <a href="{{$sub['url']}}" class="flex items-center w-full p-2 text-gray-500 text-sm transition duration-75 rounded-lg pl-11 group hover:text-blue-600 dark:text-white dark:hover:bg-gray-700">{{$sub['name']}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>

    </x-aside>
    <x-notifications />
    <!-- Page Content -->

    <div id="content-page" class="p-4 sm:ml-64 min-h-screen bg-gray-100 dark:bg-gray-900">

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