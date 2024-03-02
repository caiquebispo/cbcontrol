<?php

namespace App\Http\Livewire\BoxFront;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AllProducts extends Component
{
    use WithPagination;
    public ?int $items_page = 10;
    public ?string $search = "";
    public ?string $category_id = "";

    protected $listeners = [

        'products::index::created' => '$refresh',
        'products::index::deleted' => '$refresh',
        'products::index::updated' => '$refresh',
    ];

    protected function getAll(): object
    {
        // dd($this->items_page, $this->search, $this->category_id);

        return Auth::user()->company->products()
            ->when($this->search != "", function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->category_id != "", function ($query) {
                $query->where('category_id', $this->category_id);
            })
            ->paginate((int)$this->items_page);
    }
    private function getAllCategories(): object
    {
        return Auth::user()->company->categories;
    }

    public function render(): View
    {
        return view('livewire.box-front.all-products', [
            'products' => $this->getAll(),
            'categories' => $this->getAllCategories()
        ]);
    }
}
