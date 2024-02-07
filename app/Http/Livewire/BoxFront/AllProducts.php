<?php

namespace App\Http\Livewire\BoxFront;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AllProducts extends Component
{
    protected $listeners = [

        'products::index::created' => '$refresh',
        'products::index::deleted' => '$refresh',
        'products::index::updated' => '$refresh',
    ];

    protected function getAll()
    {
        return Auth::user()->company->products;
    }

    public function render(): View
    {
        return view('livewire.box-front.all-products', ['products' => $this->getAll()]);
    }
}
