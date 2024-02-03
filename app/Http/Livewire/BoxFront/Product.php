<?php

namespace App\Http\Livewire\BoxFront;

use App\Models\Product as ModelsProduct;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

class Product extends Component
{
    use Actions;

    public ?object $product;

    public ModelsProduct $productCart;

    public ?string $observation = null;

    public function addToCart(ModelsProduct $product, $quantity = 1): void
    {

        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => $quantity,
            'options' => [
                'path_img' => $product->image->first()?->path ?? null,
                'description' => $product->description ?? null,
                'observation' => $this->observation ?? null,
            ],
        ])->associate('App\Models\Product');
        $this->notifications();
        $this->emit('cartItem::index::addToCart');
    }

    public function notifications(): void
    {
        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Produto addicionado ao carrinho'
        );
    }

    public function render(): View
    {
        return view('livewire.box-front.product');
    }
}
