<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use MBarlow\Megaphone\Types\Important;
use WireUi\Traits\Actions;

class Delete extends Component
{
    use Actions;

    public ?Group $group;

    public ?User $user;

    public ?bool $showModal = false;

    public function __construct()
    {
        $this->group = new Group();
        $this->user = Auth::user();
    }

    public function render(): View
    {
        return view('livewire.groups.delete');
    }

    public function delete(): void
    {

        $this->group->delete();
        $this->notifications();
        $this->reset();
        $this->emitTo(ListGroup::class, 'group::index::deleted');
    }

    public function notifications(): void
    {

        $this->notification()->success(
            'Parabéns!',
            'Grupo Deletado com sucesso!'
        );
        foreach ($this->user->company->users as $user) {

            $notification = new Important(
                'Remoção de Grupo!',
                'O usuário(a) '.$this->user->name.' deletou um grupo na empresa '.$this->user->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
