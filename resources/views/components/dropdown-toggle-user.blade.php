
<div>
    <button type="button"
        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
        aria-expanded="false" data-dropdown-toggle="dropdown-user">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" src="{{url(Storage::url(auth()->user()->image()->value('path')))}}"
            alt="user photo">
    </button>
    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
        id="dropdown-user">
        <div class="px-4 py-3" role="none">
            <p class="text-sm text-gray-900 dark:text-white" role="none">
                {{auth()->user()->name}}
            </p>
            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                {{auth()->user()->email}}
            </p>
        </div>
        <ul class="py-1" role="none">
            <li>
                <a href="{{route('profile.edit')}}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">Perfil</a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{route('logout')}}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();">Sair
                        out</a>
                </form>
            </li>
        </ul>
    </div>
</div>