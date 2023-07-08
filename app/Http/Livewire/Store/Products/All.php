<?php

namespace App\Http\Livewire\Store\Products;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class All extends Component
{
    public ?object $products;
    use WithPagination;
    protected $listeners = [
        'products::index::created' => '$refresh',
        'products::index::deleted' => '$refresh',
        'products::index::updated' => '$refresh',
    ];
    
    

    public function render(): View
    {
        return view('livewire.store.products.all', ['products' => $this->getAllProducts()]);
    }
    public function getAllProducts(): Object
    {
        return $this->products;
    }
}
