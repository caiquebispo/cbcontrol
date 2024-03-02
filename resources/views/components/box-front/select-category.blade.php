@props(['categories' => []])

<x-native-select class="my-2 p-2.5" placeholder="Filtrar por categoria" :options="$categories" option-label="name"
    option-value="id" wire:model="category_id" />
