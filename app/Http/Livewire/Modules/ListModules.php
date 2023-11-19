<?php

namespace App\Http\Livewire\Modules;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ListModules extends Component
{
    protected  $listeners = [
        
        'module::index::created' => '$refresh',
        'module::index::deleted' => '$refresh',
        'module::index::updated' => '$refresh',
    ];

    public function render(): View
    {
        return view('livewire.modules.list-modules');
    }
}
