@props(['path'])
@php
    $realPath = $path == null ? '/img/logo/cb-logo.png' : url(Storage::url($path))
 @endphp
<div class="w-full flex justify-center my-4">
    <img class="w-20 h-w-20 rounded-full" src="{{$realPath}}" alt="user photo">
</div>
