@props(['title' => '','show', 'size' => 'md'])
@php
    $size = $size === 'md' ? 2 : 7;
@endphp
@if($show)
<div class="fixed inset-0 flex items-center justify-center z-50">
    <div class="fixed inset-0 bg-cyan-600 bg-opacity-10 backdrop-blur-sm"></div>
    <div class="relative w-full max-w-{{$size}}xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{$title}}
                </h3>
                <button type="button" wire:click="$toggle('showModal','false')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 space-y-3">
                {{$body}}
            </div>
            @if(isset($footer))
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    {{$footer}}
                </div>
            @endif
        </div>
    </div>
</div>
@endif
