<?php

namespace App\Http\Livewire\BoxFront;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Receveid extends Component
{
    public ?bool $showModal = false;
    public function render(): View
    {
        return view('livewire.box-front.receveid');
    }
}
