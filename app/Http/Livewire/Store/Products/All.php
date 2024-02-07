<?php

namespace App\Http\Livewire\Store\Products;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class All extends Component
{
    public ?object $products;

    use WithPagination;

    protected $listeners = [
        'products::index::created' => '$refresh',
        'products::index::deleted' => '$refresh',
        'products::index::updated' => '$refresh',
    ];

    public function render(): View
    {
        return view('livewire.store.products.all', ['products' => $this->getAllProducts()]);
    }

    public function getAllProducts(): object
    {
        return $this->products;
    }
}
