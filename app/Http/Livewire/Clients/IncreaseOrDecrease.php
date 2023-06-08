<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class IncreaseOrDecrease extends ModalComponent
{
    public User $user;
    public ?int $type_increase_or_decrease = null;
    public ?float $value = null;

    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function render(): View
    {
        return view('livewire.clients.increase-or-decrease');
    }

    public function update(): void
    {
        foreach ($this->user->company->clients as $client) {
            switch ($this->type_increase_or_decrease) {
                case 0:
                    $client->update(['value' => ($client->value - $this->value)]);
                    break;
                case 1:
                    $client->update(['value' => ($client->value + $this->value)]);
                    break;
            }
        }
        $this->reset();
        $this->emitTo(ListClients::class, 'clients::index::increase-or-decrease');
        $this->closeModal();
    }
}
