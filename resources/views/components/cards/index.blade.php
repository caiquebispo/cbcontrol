@props(['title' => null, 'value' => 0])
@php
    $value = "R$ ".number_format($value, 2,',','.');
@endphp
<div class="p-5 bg-white rounded shadow-sm dark:bg-gray-800">
    <div class="text-base text-gray-400 dark:text-gray-300">{{$title ?: 'CARD NAME'}}</div>
    <div class="flex items-center pt-1">
        <div class="text-2xl font-bold text-gray-900 dark:text-gray-100 card-{{str_replace(' ', '-',strtolower($title))}}">{{$value}}</div>
    </div>
</div>
