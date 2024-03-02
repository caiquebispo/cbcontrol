<x-native-select class="mr-2" :options="[
    ['name' => '10', 'id' => 10],
    ['name' => '20', 'id' => 20],
    ['name' => '50', 'id' => 50],
    ['name' => '100', 'id' => 100],
]" option-label="name" option-value="id" wire:model="items_page" />
