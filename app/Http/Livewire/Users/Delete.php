<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use MBarlow\Megaphone\Types\Important;
use WireUi\Traits\Actions;

class Delete extends Component
{
    use Actions;

    public ?User $user;

    public ?bool $showModal = false;

    public function __construct()
    {

        $this->user = new User;
    }

    public function render()
    {
        return view('livewire.users.delete');
    }

    public function delete(): void
    {
        $this->user->delete();
        $this->notifications();
        $this->reset();
        $this->emitTo(ListUsers::class, 'users::index::deleted');
    }

    public function notifications(): void
    {

        $this->notification()->success(
            'Parabéns!',
            'Usuário Deletado com sucesso!'
        );
        foreach (Auth::user()->company->users as $user) {

            $notification = new Important(
                'Remoção de Usuário!',
                'O usuário(a) '.Auth::user()->name.' deletou um usuário na empresa '.$this->user->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
