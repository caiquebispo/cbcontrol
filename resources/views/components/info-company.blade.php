<div class="w-full content-info-compan flex flex-col items-center">
    @if(auth()->user()->company->image()->value('path') == null)
    <div class="content-logo-company w-20 h-20 rounded-full border border-gray-500">

    </div>
    @else
     <img class="w-20 h-w-20 rounded-full" src="{{url(Storage::url(auth()->user()->company->image()->value('path')))}}"
    @endif
            alt="user photo">
    <p class="w-full bg-gray-800 dark:bg-gray-950 rounded-lg p-2 text-md font-semibold text-gray-100 text-center uppercase my-3">
        {{auth()->user()->company->corporate_reason}}
    </p>
</div>