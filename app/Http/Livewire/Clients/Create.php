<?php

namespace App\Http\Livewire\Clients;


use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public User $user;

    public ?string $full_name = null;
    public ?string $number_phone = null;
    public ?float $value = null;
    public ?string $payment_method = null;
    public ?string $local = null;
    public ?string $delivery = null;
    public ?string $birthday = null;
    public ?int $group_id = null;
    
    protected $rules = [

        'full_name' => 'required|min:4|max:150',
        'number_phone' => 'required|max:16',
        'value' => 'required',
        'payment_method' => 'required|min:4|max:16',
        'delivery' => 'required|min:4|max:16',
        'local' => 'string',
        'birthday' => 'required|date',
    ];

    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function render()
    {
        $groups = $this->user->company->groups;
        return view('livewire.clients.create', compact('groups'));
    }
    public function create(): void
    {
        
        $validated = $this->validate();

        $this->user->company->clients()->create($validated)->groups()->attach($this->group_id);
        $this->reset();
        $this->emitTo(ListClients::class, 'clients::index::created');
        $this->closeModal();
    }
}
