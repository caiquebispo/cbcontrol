<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListPhotos extends Component
{
    public Product $product;
    
    protected $listeners = [
        'products::index::deleted' => 'getPhotos',
        'products::index::created' => 'getPhotos'
    ];
    public function __construct()
    {
        $this->product = new Product;
    }
    public function render()
    {
        return view('livewire.products.list-photos',['images' => $this->getPhotos()]);
    }
    public function getPhotos(): Collection
    {
        return $this->product->image;
    }
}
