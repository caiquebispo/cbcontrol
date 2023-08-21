<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class SendWhatsAppMessage extends ModalComponent
{
    use Actions;
    public Client $client;
    public function render()
    {
        return view('livewire.clients.send-whats-app-message');
    }
}
