<?php

namespace App\Http\Livewire\Store\Cart;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class ModalCartItens extends ModalComponent
{   

    public ?int $quantity = 0;
    public function render(): View
    {
        
        return view('livewire.store.cart.modal-cart-itens',['items' => \Cart::content()]);
    }
}
