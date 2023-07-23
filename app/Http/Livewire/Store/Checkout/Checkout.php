<?php

namespace App\Http\Livewire\Store\Checkout;


use App\Models\Company;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Checkout extends ModalComponent
{
    public  Product $product;
    public  Company $company;
    public  function  mount(Product $product): void
    {
        $this->product = $product;
        $this->company = $this->product->company;
    }
    public function render(): View
    {
        return view('livewire.store.checkout.checkout');
    }
}
