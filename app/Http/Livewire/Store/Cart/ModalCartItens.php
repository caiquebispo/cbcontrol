<?php

namespace App\Http\Livewire\Store\Cart;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class ModalCartItens extends ModalComponent
{

    public function render(): View
    {
        return view('livewire.store.cart.modal-cart-itens', ['items' => \Cart::content()]);
    }

    public function increment($rowId): void
    {
        $product = \Cart::get($rowId);
        $qty = $product->qty + 1;
        \Cart::update($rowId, $qty);
        $this->emit('cartItem::index::updateQuantityItemCart');
    }

    public function decrement($rowId): void
    {
        $product = \Cart::get($rowId);
        $qty = $product->qty - 1;
        \Cart::update($rowId, $qty);
        $this->emit('cartItem::index::updateQuantityItemCart');
    }

    public function remove($rowId): void
    {
        \Cart::remove($rowId);
        $this->emit('cartItem::index::removeItemCart');
    }

    public function clearCart(): void
    {
        \Cart::destroy();
        $this->emit('cartItem::index::cleanCart');
    }

}
