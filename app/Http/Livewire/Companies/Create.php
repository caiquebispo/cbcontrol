<?php

namespace App\Http\Livewire\Companies;

use Livewire\Component;

class Create extends Component
{
    public $network;
    public ?bool $showModal = false;
    
    public function render()
    {
        return view('livewire.companies.create');
    }
}
