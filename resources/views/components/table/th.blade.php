@props(['direction', 'sortable'=> false])
@php
$class = $sortable ? 'cursor-pointer' : '';
@endphp
<th {{$attributes->merge(['class' => 'px-4 py-3'])}}>
    <p class="flex {{$class}}">
        {{$slot}}
        @if($sortable)
             @if($direction === 'asc')
                <x-bi-chevron-up class="ml-2"/>
            @else
                <x-bi-chevron-down class="ml-2"/>
            @endif
        @endif
    </p>
</th>
