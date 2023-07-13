<?php

namespace App\Http\Livewire\Store\Cart;

use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class ModalCartItens extends ModalComponent
{
    public function render(): View
    {
        return view('livewire.store.cart.modal-cart-itens');
    }
}
