<?php

namespace App\Http\Livewire\Store\Products;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalProduct extends ModalComponent
{
    public Product $product;
    public ?int $quantity = 1;
    
    protected $listeners = ['incrementQuantity' => 'increment','decrementQuantity' => 'decrement'];


    public function mount(Product $product, $quantity = 1): void
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }
    public function render():View
    {
        return view('livewire.store.products.modal-product');
    }
    public function increment(): int
    {
        return $this->quantity++;
    }
    public function decrement(): int
    {
        if($this->quantity > 1){
            return $this->quantity--;
        }else{
            return $this->quantity;
        }
    }
}
