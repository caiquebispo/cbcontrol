<?php

namespace App\Http\Livewire\BoxFront;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class TotalCartItemsPrice extends Component
{
    protected $listeners = [
        'cartItem::index::addToCart' => '$refresh',
        'cartItem::index::cleanCart' => '$refresh',
        'cartItem::index::updateQuantityItemCart' => '$refresh',
        'cartItem::index::removeItemCart' => '$refresh',
        'cartItem::index::finishSale' => '$refresh',
    ];

    public function render(): View
    {
        return view('livewire.box-front.total-cart-items-price', ['total' => \Cart::subtotal()]);
    }
}
