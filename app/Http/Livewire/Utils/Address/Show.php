<?php

namespace App\Http\Livewire\Utils\Address;

use App\Models\Client;
use Livewire\Component;

class Show extends Component
{
    public object $client;

    public function mount(Client $client)
    {
        $this->client = $client;
    }

    public function render()
    {
        return view('livewire.utils.address.show');
    }
}
