<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Delete extends ModalComponent

{   public Client $client;
    public function __construct()
    {
        
        $this->client = new Client;
    }
    public function render()
    {
        return view('livewire.clients.delete');
    }
    public function delete():void
    {

        $this->client->delete();
        $this->reset();
        $this->emitTo(ListClients::class, 'clients::index::deleted');
        $this->closeModal();
    }
}
