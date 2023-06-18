<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class UpdatePassword extends ModalComponent
{
    use Actions;
    public User $user;
    public ?string $password = null;
    public ?string $password_confirm = null;

    protected $rules = [

        'password' => 'required|min:8|max:16',
        'password_confirm' => 'required|min:8|max:16|same:password'

    ];

    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function render(): View
    {
        return view('livewire.users.update-password');
    }

    public function update(): void
    {
        $this->validate();
        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Senha Alterada com sucesso!'
        ); 
        $this->user->update($this->validateOnly('password'));
        $this->reset();
        $this->emitTo(ListUsers::class, 'users::index::updated-password');
        $this->closeModal();
    }
}
