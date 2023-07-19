<?php

namespace App\Http\Livewire\Store\Products;

use App\Models\Product;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ModalProduct extends ModalComponent
{
    use Actions;   
    public Product $product;
    public ?int $quantity = 1;
    
    protected $listeners = ['incrementQuantity' => 'increment','decrementQuantity' => 'decrement'];


    public function mount(Product $product, int $quantity = 1): void
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
    public function addToCart(Product $product, $quantity): void
    {
        
        \Cart::add([
            'id' => $product->id, 
            'name'=> $product->name, 
            'price' => $product->price,
            'qty' => $quantity,
            'options' =>[
                'path_img' =>  $product->image->first()?->path ?? null,
                'description' =>  $product->description ?? null
            ]
        ]);
        $this->notifications();
        $this->closeModal();
        $this->emit('cartItem::index::addToCart');
        
    }
    public function notifications(): void
    {
        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Produto addicionado ao carrinho'
        ); 
    }
}
