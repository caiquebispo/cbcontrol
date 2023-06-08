<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

use LivewireUI\Modal\ModalComponent;

class Update extends ModalComponent
{
    public Client $client;
    public User $user;

    public ?string $full_name = null;
    public ?string $number_phone = null;
    public ?float $value = null;
    public ?string $payment_method = null;
    public ?string $local = null;
    public ?string $delivery = null;
    public ?int $group_id = null;
    
    
    public function rules(){
        
        return [

            'client.full_name' => 'required|min:4|max:150',
            'client.number_phone' => 'required|string|min:4|unique:clients,number_phone,' . $this->client->id,
            'client.value' => 'required',
            'client.payment_method' => 'required|min:4|max:16',
            'client.delivery' => 'required|min:4|max:16',
            'client.local' => 'string',
        ];
    }
    public function __construct()
    {
        $this->client = new Client;
        $this->user = Auth::user();
    }
    public function render()
    {
        $groups = $this->user->company->groups;
        return view('livewire.clients.update', compact('groups'));
    }
    public function update(): void
    {
        
        $this->validate();
        $this->client->save();
        $this->client->groups()->detach();
        $this->client->groups()->attach($this->group_id);
        $this->reset();
        $this->emitTo(ListClients::class, 'clients::index::updated');
        $this->closeModal();
    }
}
