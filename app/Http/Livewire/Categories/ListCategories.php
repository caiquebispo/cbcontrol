<?php

namespace App\Http\Livewire\Categories;

use App\Traits\Table\SettingTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategories extends Component
{
    use WithPagination;
    use SettingTable;

    protected  $listeners = [
        'categories::index::created' => '$refresh',
        'categories::index::deleted' => '$refresh',
        'categories::index::updated' => '$refresh',
    ];

    public function render(): View
    {
    return view('livewire.categories.list-categories', ['categories' => $this->getCategories()]);
    }
    public function getCategories(): object
    {
        return Auth::user()->company->categories()
            ->when($this->search != "", fn($query) => $query->where('name', 'like', '%'.$this->search."%"))
            ->orderBy($this->setSortField('name'), $this->sortDirection)
            ->paginate($this->qtyItemsForPage);
    }

}
