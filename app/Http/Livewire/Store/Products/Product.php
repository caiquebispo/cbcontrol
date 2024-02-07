<?php

namespace App\Http\Livewire\Store\Products;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Product extends Component
{
    public ?object $product;

    protected $listeners = [
        'products::index::created' => '$refresh',
        'products::index::deleted' => '$refresh',
        'products::index::updated' => '$refresh',
    ];

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render(): View
    {
        return view('livewire.store.products.product', ['product' => $this->getProduct()]);
    }

    public function getProduct(): object
    {
        return $this->product;
    }
}
