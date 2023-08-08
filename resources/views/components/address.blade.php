@props(['address'])
<div class="container mx-auto p-4 my-4">
    <h1 class="text-lg sm:text-2xl font-bold mb-8 text-left text-gray-700">Endereço de entrega</h1>
    @if(sizeof($address))
        <ul class="grid w-full gap-6 grid-cols-1">
            @foreach($address as $ad)
            <li>
                <input wire:model.defer="address" type="radio" id="hosting-small-{{$ad->id}}" name="address" value="{{$ad}}" class="hidden peer">

                <label for="hosting-small-{{$ad->id}}" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-500 peer-checked:border-orange-600 peer-checked:text-orange-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="block">
                        <div class="w-full text-lg font-semibold hidden">0-50 MB</div>
                        <div class="w-full">
                            {{$ad->city}},{{$ad->states}},{{$ad->zipe_code}},{{$ad->neighborhood}},{{$ad->road}},{{$ad->number}}
                        </div>
                    </div>
                    <svg class="w-5 h-5 ml-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </label>
            </li>
            @endforeach
        </ul>
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
                <span class="font-medium">Aviso!</span> Você ainda não possue endereçõ cadastrado !
            </div>
        </div>
    @endif
</div>
