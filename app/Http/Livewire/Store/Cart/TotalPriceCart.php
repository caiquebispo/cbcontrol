<?php

namespace App\Http\Livewire\Store\Cart;

use Livewire\Component;

class TotalPriceCart extends Component
{
    protected $listeners = [
        'cartItem::index::addToCart' => '$refresh',
        'cartItem::index::updateQuantityItemCart' => '$refresh',
        'cartItem::index::removeItemCart' => '$refresh',
        'cartItem::index::cleanCart' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.store.cart.total-price-cart');
    }
}
