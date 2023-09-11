<div>
    @if(count($images) > 0)
    <div class="flex flex-col sm:flex-row justify-evenly my-8">
        @foreach($images as $img)
        <figure class="my-3 relative">
            <img class="rounded-lg sm:w-36 sm:h-36 w-full border border-2 p-1" src="{{url(Storage::url($img->path))}}"
                alt="{{$img->path}}">
            <figcaption
                class="absolute top-[-20px] right-2 sm:right-[-20px] bg-red-300 w-10 h-10 rounded-full shadow-md cursor-pointer flex justify-center items-center">
                <livewire:products.delete-photo :img="$img" :key="$img.'-delete'" />
            </figcaption>
        </figure>
        @endforeach
    </div>
    @else
    <div class="w-full flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
        role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Aviso</span>
        <div>
            <span class="font-medium">Aviso!</span> Esse produto ainda não possui imagem associada !
        </div>
    </div>
    @endif
</div>
