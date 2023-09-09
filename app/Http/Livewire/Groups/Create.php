<?php

namespace App\Http\Livewire\Groups;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;
    public User $user;
    public ?string $name = null;
    public ?bool $showModal = false;

    protected $rules = [

        'name' => 'required|min:4|max:150'
    ];

    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function render(): View
    {
        return view('livewire.groups.create');
    }
    public function create(): void
    {
        $validated = $this->validate();
        $this->notifications();
        $this->user->company->groups()->updateOrCreate($validated,$validated);
        $this->reset();
        $this->emitTo(ListGroup::class, 'group::index::created');
    }
    public function notifications(){

        $this->notification()->success(
            $title = 'Parabéns!',
            $description =  'Grupo Criado com sucesso!'
        );
        foreach($this->user->company->users as $user){

            $notification = new \MBarlow\Megaphone\Types\General(
                'Cadastro de Grupo!',
                'O usuário(a) '.$this->user->name.' cadatrou um novo grupo na empresa '.$this->user->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }

}
