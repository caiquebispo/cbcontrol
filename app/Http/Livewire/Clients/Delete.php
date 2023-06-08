<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Delete extends ModalComponent

{   public User $user;
    public function __construct()
    {
        
        $this->user = Auth::user();
    }
    public function render()
    {
        return view('livewire.clients.delete');
    }
    public function delete():void
    {

        $this->user->delete();
        $this->reset();
        $this->emitTo(ListClients::class, 'clients::index::deleted');
        $this->closeModal();
    }
}
