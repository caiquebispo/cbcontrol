<?php

namespace App\Http\Livewire\Clients;

use App\Models\GroupUser;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public User $user;
    public GroupUser $groupUser;

    public ?string $name = null;
    public ?string $number_phone = null;
    public ?string $number_phone_alternative = null;
    public ?string $cpf = null;
    public ?string $birthday = null;
    public ?int $group_id = null;
    
    protected $rules = [

        'name' => 'required|min:4|max:150',
        'number_phone' => 'required|max:16',
        'number_phone_alternative' => 'nullable|max:16',
        'cpf' => 'required|min:4|max:16',
        'birthday' => 'string',
    ];

    public function __construct()
    {
        $this->groupUser = new GroupUser;
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

        
        $validated['birthday'] = DateTime::createFromFormat('d/m/Y', $validated['birthday'])->format('Y-m-d');
        $this->user->company->users()->create($validated)->groups()->attach($this->group_id);
        $this->reset();
        $this->emitTo(ListClients::class, 'clients::index::created');
        $this->closeModal();
    }
}
