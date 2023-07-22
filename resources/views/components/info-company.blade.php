<div class="w-full content-info-compan flex flex-col items-center">

    <x-company-image :path="auth()->user()->company->image()->value('path')" />

    <p class="w-full bg-gray-900 dark:bg-gray-950 rounded-lg p-1 text-md font-semibold text-gray-300 text-center uppercase my-3">
        {{auth()->user()->company->corporate_reason}}
    </p>
</div>
