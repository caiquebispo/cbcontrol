<div class="w-full content-info-compan flex flex-col items-center">
    @if(auth()->user()->company->image()->value('path') == null)
    
        <img class="w-20 h-w-20 rounded-full" src="/img/logo/cb-logo.png" alt="user photo">
    
    @else
        <img class="w-20 h-w-20 rounded-full" src="{{url(Storage::url(auth()->user()->company->image()->value('path')))}}" alt="user photo">
    @endif
    <p class="w-full bg-gray-900 dark:bg-gray-950 rounded-lg p-1 text-md font-semibold text-gray-300 text-center uppercase my-3">
        {{auth()->user()->company->corporate_reason}}
    </p>
</div>