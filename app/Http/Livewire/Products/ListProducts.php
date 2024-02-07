<?php

namespace App\Http\Livewire\Products;

use App\Traits\Table\SettingTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListProducts extends Component
{
    use SettingTable;
    use WithPagination;

    protected $listeners = [
        'products::index::created' => '$refresh',
        'products::index::deleted' => '$refresh',
        'products::index::updated' => '$refresh',
    ];

    public function render(): View
    {
        return view('livewire.products.list-products', ['products' => $this->getProducts()]);
    }

    public function getProducts(): object
    {
        return Auth::user()->company->products()
            ->when($this->search != '', fn ($query) => $query->where('name', 'like', '%'.$this->search.'%'))
            ->orderBy($this->setSortField('name'), $this->sortDirection)
            ->paginate($this->qtyItemsForPage);
    }
}
