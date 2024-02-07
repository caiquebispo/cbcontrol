<?php

namespace App\Http\Livewire\Store\Cart;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class TotalItensCart extends Component
{
    protected $listeners = ['cartItem::index::addToCart' => 'getTotalItemsCart'];

    public function render(): View
    {
        return view('livewire.store.cart.total-itens-cart', ['totalCartItems' => $this->getTotalItemsCart()]);
    }

    public function getTotalItemsCart(): int
    {
        //  \Cart::destroy();
        return count(\Cart::content());
    }
}
