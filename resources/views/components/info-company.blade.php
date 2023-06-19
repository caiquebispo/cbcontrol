<div class="w-full content-info-compan flex flex-col items-center">
    <div class="content-logo-company w-20 h-20 rounded-full border border-gray-500">

    </div>
    <p class="w-full bg-gray-800 dark:bg-gray-950 rounded-lg p-2 text-md font-semibold text-gray-100 text-center uppercase my-3">
        {{auth()->user()->company->corporate_reason}}
    </p>
</div>