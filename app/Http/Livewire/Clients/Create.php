<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public function render()
    {
        return view('livewire.clients.create');
    }
}
