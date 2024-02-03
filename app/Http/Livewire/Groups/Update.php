<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use MBarlow\Megaphone\Types\General;
use WireUi\Traits\Actions;

class Update extends Component
{
    use Actions;

    public ?Group $group;

    public ?User $user;

    public ?bool $showModal = false;

    public ?string $name = null;

    protected array $rules = [

        'group.name' => 'required|min:4|max:150',
    ];

    public function __construct()
    {
        $this->group = new Group;
        $this->user = Auth::user();
    }

    public function render(): View
    {
        return view('livewire.groups.update');
    }

    public function update(): void
    {
        $this->validate();
        $this->group->save();

        $this->notifications();
        $this->reset();
        $this->emitTo(ListGroup::class, 'group::index::updated');
    }

    public function notifications(): void
    {

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Grupo Editado com sucesso!'
        );
        foreach ($this->user->company->users as $user) {

            $notification = new General(
                'Atualização de Grupo!',
                'O usuário(a) '.$this->user->name.' editou as informações de um grupo na empresa '.$this->user->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
