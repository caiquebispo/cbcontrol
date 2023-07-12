<?php

namespace App\Http\Livewire\Store\Products;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class SlideShowModalProduct extends Component
{
    public ?object $images;

    public function render(): View
    {
        return view('livewire.store.products.slide-show-modal-product');
    }
    
}
