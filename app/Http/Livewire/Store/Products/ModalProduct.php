<?php

namespace App\Http\Livewire\Store\Products;

use App\Models\Product;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalProduct extends ModalComponent
{
    public Product $product;

    public function mount(Product $product): void
    {
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.store.products.modal-product');
    }
}
