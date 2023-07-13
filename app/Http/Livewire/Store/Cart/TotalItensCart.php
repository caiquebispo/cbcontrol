<?php

namespace App\Http\Livewire\Store\Cart;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class TotalItensCart extends Component
{
    public ?int $totalCartItems = 0;
    public function mount(): void
    {
        
        $this->totalCartItems = \Cart::count();
    }
    public function render(): View
    {
        return view('livewire.store.cart.total-itens-cart');
    }
}
