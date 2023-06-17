<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public User $user;
    public ?string $name = null;
    public ?string $number_phone = null;
    public ?string $email = null;
    public ?string $birthday = null;
    public ?string $password = null;
    public ?string $password_confirm = null;

    protected $rules = [

        'name' => 'required|min:4|max:150',
        'number_phone' => 'required|max:16|unique:users',
        'email' => 'required|email|unique:users',
        'birthday' => 'required|date',
        'password' => 'required|min:8|max:16',
        'password_confirm' => 'required|min:8|max:16|same:password'

    ];

    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function render()
    {
        return view('livewire.users.create');
    }

    public function create(): void
    {   
        $this->validate();
        $data = [
            'name' => $this->name,
            'number_phone' =>  $this->number_phone,
            'email' => $this->email,
            'birthday' => $this->birthday,
            'password' => $this->password,
            'company_id' => $this->user->company_id,
        ];
    
        $this->user->company->users()->create($data);
        $this->reset();
        $this->emitTo(ListUsers::class, 'users::index::created');
        $this->closeModal();   
        
    }
}
