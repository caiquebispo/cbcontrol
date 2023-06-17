<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Delete extends ModalComponent
{
    public User $user;
    public function __construct()
    {
        
        $this->user = new User;
    }
    public function render()
    {
        return view('livewire.users.delete');
    }
    public function delete():void
    {

        $this->user->delete();
        $this->reset();
        $this->emitTo(ListUsers::class, 'users::index::deleted');
        $this->closeModal();
    }
}
