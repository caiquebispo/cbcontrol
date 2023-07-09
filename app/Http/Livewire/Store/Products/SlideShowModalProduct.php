<?php

namespace App\Http\Livewire\Store\Products;

use Livewire\Component;

class SlideShowModalProduct extends Component
{
    public ?object $images;
    public function render()
    {
        return view('livewire.store.products.slide-show-modal-product');
    }
}
