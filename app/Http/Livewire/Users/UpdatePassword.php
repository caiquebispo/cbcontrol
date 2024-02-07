<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use MBarlow\Megaphone\Types\General;
use WireUi\Traits\Actions;

class UpdatePassword extends Component
{
    use Actions;

    public ?User $user;

    public ?string $password = null;

    public ?string $password_confirm = null;

    public ?bool $showModal = false;

    protected array $rules = [

        'password' => 'required|min:8|max:16',
        'password_confirm' => 'required|min:8|max:16|same:password',

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
        $this->emitTo(ListUsers::class, 'users::index::updated-password');
    }

    public function notifications(): void
    {

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Senha Alterada com sucesso!'
        );
        foreach (Auth::user()->company->users as $user) {

            $notification = new General(
                'Atualização de Senha!',
                'O usuário(a) '.Auth::user()->name.' atualizou as senha de um usuário na empresa '.$this->user->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
