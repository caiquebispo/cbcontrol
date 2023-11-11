<div class="w-full content-info-compan flex flex-col items-center">
        @if(isset(auth()->user()->company))
            <x-company-image :path="auth()->user()->company->image()->value('path')" />
        @endif
    <p class="w-full bg-gray-900 dark:bg-gray-950 rounded-lg p-1 text-md font-semibold text-gray-300 text-center uppercase my-3">
        @if(isset(auth()->user()->company))    
            {{auth()->user()->company->corporate_reason}}
        @endif
    </p>
</div>
