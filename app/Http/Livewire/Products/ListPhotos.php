<?php

namespace App\Http\Livewire\Products;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListPhotos extends Component
{
    public object $product;

    protected $listeners = [
        'products::index::deleted' => '$refresh',
        'products::index::created' => '$refresh'
    ];

    public function render(): View
    {
        return view('livewire.products.list-photos',['images' => $this->getPhotos()]);
    }
    public function getPhotos(): Collection|array
    {
        return $this->product->image ?: [];
    }
}
