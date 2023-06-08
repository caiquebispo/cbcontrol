<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use LivewireUI\Modal\ModalComponent;

class Update extends ModalComponent
{
    public User $user;
    

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
        $this->user = Auth::user();
    }
    public function render()
    {
        $groups = $this->user->company->groups;
        return view('livewire.clients.update', compact('groups'));
    }
    public function update(): void
    {
        
        $validated = $this->validate();
        $validated['birthday'] = DateTime::createFromFormat('d/m/Y', $validated['birthday'])->format('Y-m-d');
        $this->user->where('id', $this->user->id)->update($validated);
        $this->user->groups()->detach();
        $this->user->groups()->attach($this->group_id);
        $this->reset();
        $this->emitTo(ListClients::class, 'clients::index::updated');
        $this->closeModal();
    }
}
