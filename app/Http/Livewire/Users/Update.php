<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Update extends ModalComponent
{
    public User $user;
    public ?string $name = null;
    public ?string $number_phone = null;
    public ?string $email = null;
    public ?string $birthday = null;
    public ?bool $status = null;

    public function rules()
    {
        return [

            'user.name' => 'required|min:4|max:150',
            'user.number_phone' => 'required|string|min:4|unique:users,number_phone,' . $this->user->id,
            'user.email' => 'required|email|unique:users,email,' . $this->user->id,
            'user.birthday' => 'required|date',
            'user.status' => 'required',
    
        ];
    }

    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function render(): View
    {
        return view('livewire.users.update');
    }
    public function update(): void
    {
        
        $this->validate();
        $this->user->save();
        $this->reset();
        $this->emitTo(ListUsers::class, 'users::index::updated');
        $this->closeModal();
    }
}
