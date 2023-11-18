<?php

namespace App\Http\Livewire\Modules;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    public ?bool $showModal = false;
    
    public function render(): View
    {
        return view('livewire.modules.create');
    }
}
