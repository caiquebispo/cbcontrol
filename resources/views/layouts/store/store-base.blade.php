<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head class="dark">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:site_name" content="Cbfood Delivery">
    <meta property="og:title" content="Cbfood Delivery Plataform" />
    <meta property="og:description" content="Plataforma de Delivery, densenvolvida pensando em você !" />
    <meta property="og:image" itemprop="image" content="https://i.postimg.cc/wv0DWcx8/Group-1.png">
    <meta property="og:image" content="https://i.postimg.cc/wv0DWcx8/Group-1.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
    <title>Store - @yield('title')</title>
    @if($company->image()->value('path') != null)
        <link rel="icon" href="{{url(Storage::url($company->image()->value('path')))}}" />
     @else
         <link rel="icon" href="/img/logo/cb-logo.png" />
     @endif

    <link rel="icon" href="{{url(Storage::url($company->image()->value('path')))}}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @livewire('livewire-ui-modal')
    <wireui:scripts />
    @livewireScripts
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{--livewire --}}
    @livewireStyles

</head>

<body class="font-sans antialiased">
    <header
        class="header w-full h-[450px] sm:flex sm:items-center flex items-center border border-b-3 bg-white bg-cover bg-no-repeat bg-center" @if($company->image()->value('path') != null) style="background-image: url('{{url(Storage::url($company->image()->value('path')))}}')" @else style="background-image: url('/img/logo/wallpaper-cb.png')" @endif >
        <div class="w-full h-full mx-auto flex justify-center items-center"
            style="background-image: radial-gradient(hsl(0deg 0% 0% / 70%), transparent)">
            <div class="conten-ifon-company flex flex-col items-center">

                <img alt=""
                    @if($company->image()->value('path') != null) src="{{url(Storage::url($company->image()->value('path')))}}" @else src="/img/logo/cb-logo.png" @endif width="150px" height="150px" class="rounded-full">
                <div class="name-comapny mt-3 text-white font-medium text-4xl uppercase text-center">
                    <h4>{{$company->corporate_reason}}</h4>
                </div>

                <div class="name-comapny mt-3 text-white font-medium text-1xl flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-pin-map-fill hidden sm:flex" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z" />
                        <path fill-rule="evenodd"
                            d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z" />
                    </svg>
                    <p class="ml-2 uppercase text-center mb-4">
                        @if(@count($company->address) > 0)
                            {{implode(',',$company->address()->select('city','states','zipe_code','neighborhood','road','number')->first()->toArray())}}
                        @else
                            Essa empresa ainda não cadastrou um endereço...
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </header>
    <section class="bar-alert w-full h-[50px] shadow-lg">
        <div class="container mx-auto h-[50px] flex items-center justify-between font-bold text-gray-600">
            <section class="text-orange-600 text-2xl">

            </section>

            <div class="content-alert-bar-menu flex ">
                @if (!Auth::guest())


                    <div class="btn-group ">
                        <button type="button" class="dropdown-toggle flex items-center mr-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <p class="mr-2">Olá {{Auth::user()->name}}</p>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                          <button class="dropdown-item my-bag hidden">Minha Sacola</button>
                          <button class="dropdown-item logout-user" >Sair</button>
                        </div>
                      </div>
                      <a href="#" class="my-bag mr-3 text-orange-600 hove:text-orange-600 active:text-orange-600">
                        <x-svg-icon :icon="'bi-bag-fill'"/>
                @else
                    <a href="#" class="show-modal-login-user mr-2" type="button" style="text-decoration:none">Login</a>

                @endif

                <a href="#" class="relative hidden open-shopping-cart" >
                    <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                     </svg>
                     <div class="total-itemCart absolute top-[-17px] right-[-5px] text-bold">
                        <livewire:store.cart.total-itens-cart />
                     </div>
                </a>
            </div>
        </div>

    </section>
    <div class="mx-auto w-[78%] mt-4 flex justify-end">
        <article
            class="flex items-center font-bold @if($company->settings->second_color != null) text-[{{$company->settings->second_color}}] @else text-orange-600 @endif">
            <p class="mr-3">Fale Conosco</p>
            <p>

                <a href="https://api.whatsapp.com/send?phone={{preg_replace( '/[^0-9]/','',$company->phone)}}&text=Óla ! Vim pelo site."
                    class="btn btn-success" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-whatsapp text-green-600" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                    </svg>

                </a>
            </p>
        </article>
    </div>

    <div class="container mx-auto">
        @if(!$company->status)
        <div class=" mt-4">
            <div id="alert-additional-content-2" class="p-4 mb-4 border border-red-300 rounded-lg bg-red-50 dark:bg-red-200"
                role="alert">
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-5 h-5 mr-2 text-red-900 dark:text-red-800" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Info</span>
                    <h3 class="text-lg font-medium text-red-900 dark:text-red-800">Aviso</h3>
                </div>
                <div class="mt-2 mb-4 text-sm text-red-900 dark:text-red-800">
                    Essa empresa em encontrasse inativa, não será possível adicionar itens ao carrinho ou finalizar comprar.
                </div>
            </div>
        </div>
        @endif
        @if(!$company->settings->is_opened)
        <div class=" mt-4">
            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                <p class="font-bold">Aviso</p>
                <p>Essa loja encorou o expediente por hoje, mas fique tranquilo os seus pedidos serão salvos e poderão ser
                    preparado e entregues amanhã.</p>
            </div>
        </div>
        @endif
        @if(!$company->settings->has_delivery)
        <div class=" mt-4">
            <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                <p class="font-bold">Informativo</p>
                <p class="text-sm">Desculpe mas não estamos com o delivery disponível hoje, somente retirada na nossa loja
                </p>
            </div>
        </div>
        @endif
    </div>
     <x-notifications />
    <section class="w-full h-full">
        <div class="container mx-auto mb-3">
            @yield('content-page')
        </div>
    </section>
    <div class="w-full h-[100px] sm:h-[50px] shadow-lg fixed bottom-[-2px] z-1">
        <section class="bg-orange-600 h-12 ">
            <div class="container mx-auto flex  justify-between ">
                <article class="h-12 flex items-center justify-center font-bold text-white cursor-pointer" onclick="Livewire.emit('openModal', 'store.cart.modal-cart-itens')" >
                    <i class="bi bi-cart-fill mx-2"></i>
                    <p class="text-sm bg-orange-300 p-2 rounded-lg"> VER CARRINHO</p>
                </article>
                <article class="h-12 flex items-center " >
                    <livewire:store.cart.total-itens-cart />
                    <livewire:store.cart.total-price-cart />

                </article>
            </div>
        </section>
        <section class="menu-mobile h-12 bg-white sm:hidden flex items-center">
            <div class="container mx-auto flex justify-evenly text-2xl">
                <p class=" cursor-pointer" onClick="window.location.reload()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/>
                    </svg>
                </p>
                <p class=" cursor-pointer show-modal-user">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg>
                </p>
                <p class=" cursor-pointer my-bag">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
                    </svg>
                </p>
            </div>
        </section>
    </div>
    <footer class="w-full h-full bg-black flex  justify-center items-center">
        <div class="container mx-auto flex flex-col justify-center items-center">
            <div class="w-full footer-descritpion text-white font-bold text-xl sm:text-2xl text-left mb-[30px] font-mono">
                <div class="information-company w-full text-center text-gray-500 mt-4">
                    <p class="text-4xl">{{$company->corporate_reason}}</p>
                    <p class="text-sm w-full flex items-center justify-center mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pin-map-fill mr-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                            <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                        </svg>
                        @if(@count($company->address) > 0)
                            {{implode(',',$company->address()->select('city','states','zipe_code','neighborhood','road','number')->first()->toArray())}}
                        @else
                            Essa empresa ainda não cadastrou um endereço...
                        @endif
                    </p>
                </div>
                <div class="social-media-company w-full text-center mt-2 text-gray-500 flex items-center justify-center">
                    <a href="https://www.instagram.com/cbfooddelivery/" class="mx-3" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                        </svg>
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=7398272867&text=Óla ! Gostaria de conhecer um pouco mais da plataforma, vi a pagina da {{$company->corporate_reason}} e fiquei muito interessado." target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                          </svg>
                    </a>
                </div>
            </div>
            <div class="w-full footer-more-info border-dashed border-t-2 border-orange-600 mb-[30px]">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-gray-500 mt-[30px]">
                    <p class="text-center sm:text-left text-xs">CbSoftWare<a href="#"> Termos e Condições</a></p>
                    <p class="text-center sm:text-right text-xs">© {{date('Y')}} CbControl</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{asset('js/darkMode.js')}}"></script>
</body>

</html>
