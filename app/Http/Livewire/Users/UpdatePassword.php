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
        $this->user->update($this->validateOnly('password'));
        $this->notifications();
        $this->reset();
        $this->emitTo(ListUsersOls::class, 'users::index::updated-password');
        $this->closeModal();
    }
    public function notifications(){

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Senha Alterada com sucesso!'
        );
        foreach(Auth::user()->company->users as $user){

            $notification = new \MBarlow\Megaphone\Types\General(
                'Atualização de Senha!',
                'O usuário(a) '.Auth::user()->name.' atualizou as senha de um usuário na empresa '.$this->user->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
