<?php

namespace App\Http\Livewire\BoxFront;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AllProducts extends Component
{
    public ?string $search = '';

    protected $listeners = [

        'products::index::created' => '$refresh',
        'products::index::deleted' => '$refresh',
        'products::index::updated' => '$refresh',
    ];

    protected function getAll(): object
    {
        return Auth::user()->company->products()
            ->when($this->search != '', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->get();
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
