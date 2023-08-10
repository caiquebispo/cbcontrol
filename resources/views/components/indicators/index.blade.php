@props(['name'])
<div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
    <div class="flex justify-between">
        <div>
            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2 total-{{str_replace(' ', '-',strtolower($name))}}">----</h5>
            <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{$name}}</p>
        </div>
        <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-center share-{{str_replace(' ', '_',strtolower($name))}}">
            ----
        </div>
    </div>

    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between pt-5"></div>
</div>
