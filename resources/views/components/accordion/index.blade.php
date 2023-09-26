@props(['title'])
<div x-data="{ open: false }" class="shadow-md"  data-accordion="collapse" data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
    <h2  x-on:click="open = ! open">
        <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border  border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800" aria-expanded="true" aria-controls="accordion-color-body-1">
            <span>{{$title}}</span>
           <template x-if="open">
                   <x-bi-chevron-up />
           </template>
            <template x-if="!open">
                   <x-bi-chevron-down />
           </template>
        </button>
    </h2>
    <div id="accordion-color-body-1" x-show.important="open" aria-labelledby="accordion-color-heading-1">
        <div class="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            {{$body}}
        </div>
    </div>
</div>
